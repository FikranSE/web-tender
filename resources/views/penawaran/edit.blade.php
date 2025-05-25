@extends('layouts.app')

@section('title', 'Evaluasi Penawaran')

@section('contents')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-3xl text-gray-800">Evaluasi Penawaran</h1>
            <a href="{{ route('penawaran.index') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <hr class="mb-6" />

        <!-- Detail Penawaran Card -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 dark:bg-gray-800 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-4">Detail Penawaran</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Nama Perusahaan</p>
                    <p class="font-medium">{{ $offer->nama_perusahaan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">NPWP</p>
                    <p class="font-medium">{{ $offer->npwp }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                    <p class="font-medium">{{ $offer->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Nomor Telepon</p>
                    <p class="font-medium">{{ $offer->nomor_telepon }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Alamat</p>
                    <p class="font-medium">{{ $offer->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Harga Penawaran</p>
                    <p class="font-medium">Rp {{ number_format($offer->harga_penawaran, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @if ($offer->dokumen_perusahaan)
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Dokumen Perusahaan</p>
                            <iframe src="{{ asset('storage/' . $offer->dokumen_perusahaan) }}" width="100%" height="300px"
                                class="border border-gray-300 rounded-lg"></iframe>
                        </div>
                    @endif
                    @if ($offer->dokumen_penawaran)
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Dokumen Penawaran</p>
                            <iframe src="{{ asset('storage/' . $offer->dokumen_penawaran) }}" width="100%" height="300px"
                                class="border border-gray-300 rounded-lg"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Evaluasi -->
        <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-4">Form Evaluasi</h2>

            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <form action="{{ route('evaluasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_penawar" value="{{ $offer->id }}">

                <div class="mb-4">
                    <label for="alasan" class="block text-sm font-semibold mb-2">Alasan/Catatan Evaluasi</label>
                    <textarea name="alasan" id="alasan" rows="3"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      {{ old('alasan', $evaluasi->alasan ?? '') }}
                  </textarea>
                    @error('alasan')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="evaluasi_administrasi" id="evaluasi_administrasi"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="1"
                            {{ old('evaluasi_administrasi', $evaluasi->evaluasi_administrasi ?? false) ? 'checked' : '' }}>
                        <label for="evaluasi_administrasi" class="ml-2">Evaluasi Administrasi</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="evaluasi_teknis" id="evaluasi_teknis"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="1"
                            {{ old('evaluasi_teknis', $evaluasi->evaluasi_teknis ?? false) ? 'checked' : '' }}>
                        <label for="evaluasi_teknis" class="ml-2">Evaluasi Teknis</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="harga_penawaran" id="harga_penawaran"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="1"
                            {{ old('harga_penawaran', $evaluasi->harga_penawaran ?? false) ? 'checked' : '' }}>
                        <label for="harga_penawaran" class="ml-2">Evaluasi Harga Penawaran</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="evaluasi_penawaran" id="evaluasi_penawaran"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="1"
                            {{ old('evaluasi_penawaran', $evaluasi->evaluasi_penawaran ?? false) ? 'checked' : '' }}>
                        <label for="evaluasi_penawaran" class="ml-2">Evaluasi Penawaran</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="pemenang" id="pemenang"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="1" {{ old('pemenang', $evaluasi->pemenang ?? false) ? 'checked' : '' }}>
                        <label for="pemenang" class="ml-2">Pemenang</label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white rounded-lg px-4 py-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Simpan Evaluasi
                </button>
            </form>

        </div>
    </div>
@endsection
