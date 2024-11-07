@extends('layouts.app')

@section('title', 'Add New Tender')

@section('contents')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-3xl text-gray-800">Add Tender</h1>
            <a href="{{ route('admin/tender') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <hr class="mb-6" />
        <form action="{{ route('admin/tender/store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
            @csrf

            <!-- Display general validation errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <span class="block sm:inline">Please fix the following errors:</span>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Paket Selection -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="id_paket"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Select Paket</label>
                    <select name="id_paket" id="id_paket"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" disabled selected>Select a Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id_paket }}"
                                {{ old('id_paket') == $paket->id_paket ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_paket')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kode Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="kode_tender"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Kode Tender</label>
                    <input type="text" name="kode_tender" id="kode_tender"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter kode tender" value="{{ old('kode_tender') }}">
                    @error('kode_tender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="nama_tender"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nama Tender</label>
                    <input type="text" name="nama_tender" id="nama_tender"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter nama tender" value="{{ old('nama_tender') }}">
                    @error('nama_tender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="status"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Status</label>
                    <select name="status" id="status"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" disabled selected>Select a Status</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>draft</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>aktif</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>selesai</option>
                        <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>dibatalkan</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tahapan Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tahapan_tender_saat_ini"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tahapan Tender Saat
                        Ini</label>
                    <input type="text" name="tahapan_tender_saat_ini" id="tahapan_tender_saat_ini"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter current tender phase" value="{{ old('tahapan_tender_saat_ini') }}">
                    @error('tahapan_tender_saat_ini')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Mulai -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_mulai"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        value="{{ old('tanggal_mulai') }}">
                    @error('tanggal_mulai')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Selesai -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_selesai"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tanggal
                        Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Dokumen Pemilihan -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="dokumen_pemilihan"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Dokumen
                        Pemilihan</label>
                    <input type="file" name="dokumen_pemilihan" id="dokumen_pemilihan"
                        class="mt-2 block w-full text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('dokumen_pemilihan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hasil Evaluasi -->
                <div class="col-span-2">
                    <label for="hasil_evaluasi"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Hasil
                        Evaluasi</label>
                    <textarea name="hasil_evaluasi" id="hasil_evaluasi"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter hasil evaluasi">{{ old('hasil_evaluasi') }}</textarea>
                    @error('hasil_evaluasi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="berita_acara"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Berita acara</label>
                    <textarea name="berita_acara" id="berita_acara"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter hasil evaluasi">{{ old('berita_acara') }}</textarea>
                    @error('berita_acara')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="col-span-2 mt-4">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Submit Tender
                    </button>
                </div>
            </div>
        </form>


    </div>
@endsection
