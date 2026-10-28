<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('mahasiswa.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    + Tambah Mahasiswa
                </a>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                @endif

                <table class="min-w-full divide-y divide-gray-200 mt-4 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NRP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Angkatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jalur Masuk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($mahasiswas as $mhs)
                        <tr>
                            <td class="px-6 py-4">{{ $mhs->nrp }}</td>
                            <td class="px-6 py-4">{{ $mhs->nama }}</td>
                            <td class="px-6 py-4">{{ $mhs->angkatan }}</td>
                            <td class="px-6 py-4">{{ $mhs->jalurMasuk->nama_jalur ?? '-' }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <span>|</span>
                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>