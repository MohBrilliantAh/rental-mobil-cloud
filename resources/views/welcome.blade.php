<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SewaMobilKu - Teman Perjalanan Terpercaya Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Desain Latar Belakang Abstrak Baru (Anti Copyright Monas) */
        .unique-hero {
            background-color: #14b8a6; /* teal-500 */
            background-image: radial-gradient(#ffffff 1px, transparent 1px);
            background-size: calc(10 * 1px) calc(10 * 1px);
            background-position: -1.5px -1.5px;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-teal-600">Sewa<span class="font-light">Mobil</span>Ku</h1>
            <div class="space-x-6 text-sm font-medium">
                <a href="#" class="text-gray-600 hover:text-teal-600">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-teal-600">Armada</a>
                <a href="#" class="text-gray-600 hover:text-teal-600">Layanan</a>
                <a href="#" class="bg-teal-600 text-white px-6 py-2 rounded-full hover:bg-teal-700">Pemesanan Saya</a>
            </div>
        </div>
    </nav>

    <div class="unique-hero h-96 w-full relative flex items-center justify-center">
        <div class="text-center text-white px-6">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">Perjalanan Aman,<br>Hati Tenang.</h2>
            <p class="text-xl font-light opacity-90">Pilih mobil impianmu dan mulai petualangan sekarang!</p>
        </div>

        <div class="absolute -bottom-24 w-full px-6">
            <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
                <div class="flex space-x-3 mb-6 p-2 bg-gray-100 rounded-full w-fit mx-auto">
                    <button class="bg-teal-600 text-white px-8 py-2.5 rounded-full text-sm font-semibold">Luar Kota</button>
                    <button class="text-gray-600 px-8 py-2.5 rounded-full text-sm font-medium hover:bg-gray-200">Dalam Kota</button>
                    <button class="text-gray-600 px-8 py-2.5 rounded-full text-sm font-medium hover:bg-gray-200">Transfer Bandara</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-gray-500 mb-1.5 uppercase">Ambil Di</label>
                        <input type="text" placeholder="Contoh: Surabaya" class="w-full border p-3.5 rounded-xl bg-gray-50 text-sm focus:ring-1 focus:ring-teal-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1.5 uppercase">Tanggal Mulai</label>
                        <input type="date" value="2026-05-20" class="w-full border p-3.5 rounded-xl bg-gray-50 text-sm focus:ring-1 focus:ring-teal-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1.5 uppercase">Jam Jemput</label>
                        <input type="time" value="10:00" class="w-full border p-3.5 rounded-xl bg-gray-50 text-sm focus:ring-1 focus:ring-teal-400">
                    </div>
                    <div class="flex items-end">
                        <button class="w-full bg-teal-600 text-white p-4 rounded-xl font-semibold hover:bg-teal-700 shadow-md">Cari Armada</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h-28"></div> <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-900 mb-3">Pilihan Armada Kami</h3>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai tipe mobil yang terawat dan siap menemani perjalanan bisnis atau keluarga Anda di kota pilihan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @forelse($dataFromApi as $mobil)
                <div class="bg-white p-7 rounded-2xl border hover:border-teal-200 hover:shadow-lg transition group">
                    @if($mobil['merk'] == 'Toyota Avanza')
                        <img src="https://images.unsplash.com/photo-1593040212015-373f15998dfd?q=80&w=400&auto=format&fit=crop" alt="Toyota Avanza" class="w-full h-48 object-cover rounded-lg mb-6 group-hover:scale-105 transition-transform duration-300">
                    @else
                        <img src="https://images.unsplash.com/photo-1629891823707-1b03af87c978?q=80&w=400&auto=format&fit=crop" alt="Daihatsu Xenia" class="w-full h-48 object-cover rounded-lg mb-6 group-hover:scale-105 transition-transform duration-300">
                    @endif

                    <h4 class="text-xl font-bold mb-1">{{ $mobil['merk'] }}</h4>
                    <p class="text-xs text-gray-500 mb-5 uppercase tracking-widest">{{ ($mobil['merk'] == 'Toyota Avanza') ? 'MPV Family' : 'MPV Compact' }}</p>

                    <div class="grid grid-cols-3 gap-3 text-xs text-gray-600 mb-6 bg-gray-50 p-4 rounded-xl">
                        <div class="text-center border-r">Seats: <span class="font-semibold text-gray-900 block mt-1">7 Kursi</span></div>
                        <div class="text-center border-r">Trans: <span class="font-semibold text-gray-900 block mt-1">Matik</span></div>
                        <div class="text-center">Year: <span class="font-semibold text-gray-900 block mt-1">2024</span></div>
                    </div>

                    <div class="flex justify-between items-center pt-5 border-t">
                        <div class="text-left">
                            <span class="text-xs text-gray-400">Harga / hari</span>
                            <p class="text-2xl font-extrabold text-teal-600">Rp {{ number_format($mobil['harga_sewa'] / 1000, 0, ',', '.') }}rb</p>
                        </div>
                        <button class="bg-gray-900 text-white px-7 py-3 rounded-xl text-sm font-semibold hover:bg-teal-600">Pesan Sekarang</button>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 bg-white rounded-2xl border">
                    <p class="text-gray-500">Gagal mengambil data mobil dari backend Golang. Pastikan server Go menyala di port 8081!</p>
                </div>
            @endforelse

        </div>
    </main>

</body>
</html>