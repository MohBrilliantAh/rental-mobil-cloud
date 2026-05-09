<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ruang Kendali Super Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 font-bold text-lg">
                    Antrean Verifikasi Dokumen Pengguna
                </div>
                
                <div class="p-6 border-t border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pengguna</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokumen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($verifications as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ strtoupper($item->user->role) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ $item->file_url }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">Lihat {{ strtoupper($item->document_type) }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                    
                                    <!-- Form untuk tombol Approve -->
                                    <form action="{{ route('admin.verifications.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Approve</button>
                                    </form>

                                    <!-- Form untuk tombol Reject -->
                                    <form action="{{ route('admin.verifications.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Reject</button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Hore! Tidak ada antrean dokumen saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>