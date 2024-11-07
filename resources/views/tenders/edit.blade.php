@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-3xl text-gray-800">Edit Tender</h1>
            <a href="{{ route('admin/tender') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <hr class="mb-6" />
        @if (Session::has('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('admin.tender.update', $tender->id_tender) }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <!-- Paket Selection -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="id_paket"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Select Paket</label>
                    <select name="id_paket" id="id_paket"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" disabled>Select a Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id_paket }}"
                                {{ $tender->id_paket == $paket->id_paket ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kode Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="kode_tender"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Kode Tender</label>
                    <input type="text" name="kode_tender" id="kode_tender" value="{{ $tender->kode_tender }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter kode tender">
                </div>

                <!-- Nama Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="nama_tender"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nama Tender</label>
                    <input type="text" name="nama_tender" id="nama_tender" value="{{ $tender->nama_tender }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter nama tender">
                </div>

                <!-- Tahapan Tender -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tahapan_tender_saat_ini"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tahapan Tender Saat
                        Ini</label>
                    <input type="text" name="tahapan_tender_saat_ini" id="tahapan_tender_saat_ini"
                        value="{{ $tender->tahapan_tender_saat_ini }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter current tender phase">
                </div>

                <!-- Tanggal Mulai -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_mulai"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $tender->tanggal_mulai }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>

                <!-- Tanggal Selesai -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_selesai"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Tanggal
                        Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                        value="{{ $tender->tanggal_selesai }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>

                <!-- Dokumen Pemilihan -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="dokumen_pemilihan"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Dokumen
                        Pemilihan</label>
                    <input type="file" name="dokumen_pemilihan" id="dokumen_pemilihan"
                        class="mt-2 block w-full text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <!-- Show existing document if available -->
                    @if ($tender->dokumen_pemilihan)
                        <div class="mt-4">
                            <label class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Existing
                                Document</label>
                            <iframe src="{{ asset('storage/' . $tender->dokumen_pemilihan) }}" width="100%"
                                height="500px" class="mt-2 border border-gray-300 rounded-lg shadow-sm"></iframe>
                        </div>
                    @endif
                </div>

                <!-- Hasil Evaluasi -->
                <div class="col-span-2">
                    <label for="hasil_evaluasi"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Hasil
                        Evaluasi</label>
                    <textarea name="hasil_evaluasi" id="hasil_evaluasi"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter hasil evaluasi">{{ $tender->hasil_evaluasi }}</textarea>
                </div>

                <!-- Berita Acara -->
                <div class="col-span-2 sm:col-span-1">
                  <label for="berita_acara"
                      class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Berita acara</label>
                  <input type="file" name="berita_acara" id="berita_acara"
                      class="mt-2 block w-full text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <!-- Show existing document if available -->
                  @if ($tender->berita_acara)
                      <div class="mt-4">
                          <label class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Existing
                              Document</label>
                          <iframe src="{{ asset('storage/' . $tender->berita_acara) }}" width="100%"
                              height="500px" class="mt-2 border border-gray-300 rounded-lg shadow-sm"></iframe>
                      </div>
                  @endif
              </div>

                <!-- Status -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="status"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Status</label>
                    <select name="status" id="status"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="draft" {{ $tender->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="aktif" {{ $tender->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ $tender->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $tender->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Update Tender
                </button>
            </div>
        </form>

    </div>
@endsection
