<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mahasiswa Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('mahasiswa.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="nrp" value="NRP" />
                        <x-text-input id="nrp" class="block mt-1 w-full border-gray-300" type="text" name="nrp" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nama" value="Nama Lengkap" />
                        <x-text-input id="nama" class="block mt-1 w-full border-gray-300" type="text" name="nama" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="angkatan" value="Angkatan" />
                        <x-text-input id="angkatan" class="block mt-1 w-full border-gray-300" type="number" name="angkatan" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jalur_masuk_id" value="Jalur Masuk" />
                        <select name="jalur_masuk_id" id="jalur_masuk_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Jalur Masuk --</option>
                            @foreach($jalurMasuks as $jalur)
                                <option value="{{ $jalur->id }}">{{ $jalur->nama_jalur }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>Simpan Data</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>