package main

import (
	"context"
	"database/sql"
	"encoding/json"
	"log"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
	_ "modernc.org/sqlite" 
	"github.com/redis/go-redis/v9"
)

var ctx = context.Background()

type Mobil struct {
	ID     int    `json:"id"`
	Merk   string `json:"merk"`
	Sewa   int    `json:"harga_sewa"`
	Status string `json:"status"`
}

func main() {
	// 1. KONEKSI KE REDIS
	rdb := redis.NewClient(&redis.Options{
		Addr:     "localhost:6379", 
		Password: "",               
		DB:       0,                
	})

	// Tes koneksi Redis, kalau error biar ketahuan di awal
	_, err := rdb.Ping(ctx).Result()
	if err != nil {
		log.Println("⚠️ PENTING: Gagal konek ke Redis Server! Pastikan Service Redis sudah di-RESTART.")
	}

	// 2. KONEKSI KE SQLITE
	db, err := sql.Open("sqlite", "./rental.db")
	if err != nil {
		log.Fatal("Gagal membuka database SQLite:", err)
	}
	defer db.Close()

	// BUAT TABEL DENGAN CARA YANG LEBIH AMAN (Menghindari Nil Pointer)
	queryCreateTable := `CREATE TABLE IF NOT EXISTS mobil (
		id INTEGER PRIMARY KEY AUTOINCREMENT, 
		merk TEXT, 
		harga_sewa INTEGER, 
		status TEXT
	);`
	_, err = db.Exec(queryCreateTable)
	if err != nil {
		log.Fatal("Gagal membuat tabel mobil:", err)
	}
	
	// Isi data dummy jika tabel masih kosong
	var count int
	db.QueryRow("SELECT COUNT(*) FROM mobil").Scan(&count)
	if count == 0 {
		_, err = db.Exec("INSERT INTO mobil (merk, harga_sewa, status) VALUES ('Toyota Avanza', 300000, 'tersedia'), ('Daihatsu Xenia', 280000, 'tersedia')")
		if err != nil {
			log.Println("Gagal memasukkan data dummy:", err)
		}
	}

	// 3. SETUP ROUTER GIN
	r := gin.Default()

	r.GET("/mobil", func(c *gin.Context) {
		// LANGKAH A: Cek data di Redis Cache
		cachedData, err := rdb.Get(ctx, "cars:all").Result()
		
		if err == nil {
			var daftarMobil []Mobil
			json.Unmarshal([]byte(cachedData), &daftarMobil)

			c.JSON(http.StatusOK, gin.H{
				"source": "Diambil dari Redis Cache (Super Cepat!)",
				"data":   daftarMobil,
			})
			return
		}

		// LANGKAH B: Jika Redis kosong, ambil dari SQLite
		log.Println("Cache kosong! Mengambil data dari SQLite...")
		rows, err := db.Query("SELECT id, merk, harga_sewa, status FROM mobil")
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Gagal query database"})
			return
		}
		defer rows.Close()

		var daftarMobil []Mobil
		for rows.Next() {
			var m Mobil
			err := rows.Scan(&m.ID, &m.Merk, &m.Sewa, &m.Status)
			if err != nil {
				log.Println("Error scan data:", err)
				continue
			}
			daftarMobil = append(daftarMobil, m)
		}

		// LANGKAH C: Simpan ke Redis selama 5 menit biar hit kedua cepat
		mobilJSON, _ := json.Marshal(daftarMobil)
		rdb.Set(ctx, "cars:all", mobilJSON, 5*time.Minute)

		c.JSON(http.StatusOK, gin.H{
			"source": "Diambil langsung dari Database SQLite",
			"data":   daftarMobil,
		})
	})

	// Jalankan di port 8081 agar tidak tabrakan dengan Laragon
	log.Println("Menjalankan server di port 8081...")
	r.Run(":8081")
}