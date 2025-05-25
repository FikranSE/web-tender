@extends('layouts.user')

@section('title', 'Pengumuman')

@section('contents')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>



    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #3498db !important;
        }

        .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        .btn-login,
        .btn-register {
            border-radius: 20px;
            padding: 8px 20px;
            margin-left: 10px;
        }

        .btn-login {
            border: 2px solid #3498db;
            color: #3498db !important;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #17a2b8;
            color: white;
            font-weight: bold;
        }

        .table th {
            background-color: #e9ecef;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }
    </style>

    <div class="mt-5 p-5">
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
        <button type="button" class="btn btn-info mb-3 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Buat penawaran
        </button>

        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0"><i class="fas fa-file-contract"></i> Informasi Tender</h4>
                <a href="{{ route('listTender') }}"
                    class="text-white bg-white-600 hover:bg-white-700 focus:ring-4 focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-white-600 dark:hover:bg-white-700 dark:focus:ring-white-800">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 20%;">Kode Tender</th>
                                <td class="fw-bold">{{ $tender->kode_tender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Tender</th>
                                <td class="fw-bold">{{ $tender->nama_tender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tahap Tender Saat Ini</th>
                                <td class="text-primary">{{ $tender->tahapan_tender_saat_ini }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dokumen pemilihan</th>
                                <td>
                                    @if ($tender->dokumen_pemilihan)
                                        <div class="flex space-x-2">
                                            <a class="text-decoration-none fw-bold text-primary"
                                                href="{{ route('user.tender.downloadDocPem', ['tender' => $tender->id_tender]) }}"
                                                class="">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Rencana Umum Pengadaan</th>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode RUP</th>
                                                <th>Nama Paket</th>
                                                <th>Sumber Dana</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>45497344</td>
                                                <td>Pembangunan Gedung Pavilun VIP dan VVIP Tahap II</td>
                                                <td>APBD</td>
                                            </tr>
                                            <tr>
                                                <td>45650080</td>
                                                <td>Pembangunan Gedung Pavilun VIP dan VVIP Tahap II</td>
                                                <td>BLUD</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pembuatan</th>
                                <td>{{ $tender->tanggal_mulai }}</td>
                            </tr>

                            <tr>
                                <th scope="row">K/L/PD/Instansi Lainnya</th>
                                <td>Kota Tegal</td>
                            </tr>
                            <tr>
                                <th scope="row">Hasil evaluasi</th>
                                <td>
                                    <a href="{{ route('detailTender', $tender->id_tender) }}"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Hasil evaluasi
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Satuan Kerja</th>
                                <td>RSU KARDINAH</td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Pengadaan</th>
                                <td>Pengadaan Barang</td>
                            </tr>
                            <tr>
                                <th scope="row">Metode Pengadaan</th>
                                <td>Tender - Pascakualifikasi Dua File - Sistem Nilai</td>
                            </tr>
                            <tr>
                                <th scope="row">Tahun Anggaran</th>
                                <td>APBD 2024 - BLUD 2024</td>
                            </tr>
                            <tr>
                                <th scope="row">Nilai Pagu Paket</th>
                                <td>Rp. 20.600.000.000,00</td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Kontrak</th>
                                <td>Lumsum</td>
                            </tr>
                            <tr>
                                <th scope="row">Peserta Tender</th>
                                <td>3 Peserta</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Added modal-lg for a larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat penawaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('buatPenawaran') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
                        @csrf

                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
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
                            <input type="hidden" name="id_peserta" value="{{ Auth::id() }}">
                            <input type="hidden" name="id_tender" value="{{ $tender->id_tender }}">

                            <!-- Nama Perusahaan -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nama_perusahaan"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nama
                                    Perusahaan</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                                    value="{{ old('nama_perusahaan', $penawaran->nama_perusahaan ?? '') }}"
                                    class="mt-2 block w-full rounded-md py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- NPWP -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="npwp"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">NPWP</label>
                                <input type="text" name="npwp" id="npwp"
                                    value="{{ old('npwp', $penawaran->npwp ?? '') }}"
                                    class="mt-2 block w-full rounded-md py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- Email -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="email"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $penawaran->email ?? '') }}"
                                    class="mt-2 block w-full rounded-md py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nomor_telepon"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nomor
                                    Telepon</label>
                                <input type="text" name="nomor_telepon" id="nomor_telepon"
                                    value="{{ old('nomor_telepon', $penawaran->nomor_telepon ?? '') }}"
                                    class="mt-2 block w-full rounded-md py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- Alamat -->
                            <div class="col-span-2">
                                <label for="alamat"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Alamat</label>
                                <textarea name="alamat" id="alamat"
                                    class="mt-2 block w-full rounded-md py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('alamat', $penawaran->alamat ?? '') }}</textarea>
                            </div>

                            <!-- Dokumen Perusahaan -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="dokumen_perusahaan"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Dokumen
                                    Perusahaan</label>
                                <input type="file" name="dokumen_perusahaan" id="dokumen_perusahaan"
                                    class="mt-2 block w-full text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if ($penawaran && $penawaran->dokumen_perusahaan)
                                    <p class="mt-1 text-sm text-gray-500">Current file:
                                        {{ basename($penawaran->dokumen_perusahaan) }}</p>
                                @endif
                            </div>

                            <!-- Dokumen Penawaran -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="dokumen_penawaran"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Dokumen
                                    Penawaran</label>
                                <input type="file" name="dokumen_penawaran" id="dokumen_penawaran"
                                    class="mt-2 block w-full text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if ($penawaran && $penawaran->dokumen_penawaran)
                                    <p class="mt-1 text-sm text-gray-500">Current file:
                                        {{ basename($penawaran->dokumen_penawaran) }}</p>
                                @endif
                            </div>

                            <!-- Harga Penawaran -->
                            <div class="col-span-2 sm:col-span-1">
                                <label for="harga_penawaran"
                                    class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Harga
                                    Penawaran</label>
                                <input type="number" name="harga_penawaran" id="harga_penawaran"
                                    value="{{ old('harga_penawaran', $penawaran->harga_penawaran ?? '') }}"
                                    class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                {{ $penawaran ? 'Update Penawaran' : 'Submit Penawaran' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


@endsection
