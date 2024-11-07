@extends('layouts.user')

@section('title', 'Pengumuman')

@section('contents')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

    .nav-tabs .nav-link {
        color: #495057;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        border-bottom: 3px solid #17a2b8;
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
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-file-contract"></i> Informasi Tender</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pengumuman-tab" data-bs-toggle="tab" href="#pengumuman"
                        role="tab" aria-controls="pengumuman" aria-selected="true">
                        <i class="fas fa-bullhorn"></i> Pengumuman
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="peserta-tab" data-bs-toggle="tab" href="#peserta" role="tab"
                        aria-controls="peserta" aria-selected="false">
                        <i class="fas fa-users"></i> Peserta
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="evaluasi-tab" data-bs-toggle="tab" href="#evaluasi" role="tab"
                        aria-controls="evaluasi" aria-selected="false">
                        <i class="fas fa-chart-bar"></i> Hasil Evaluasi
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pemenang-tab" data-bs-toggle="tab" href="#pemenang" role="tab"
                        aria-controls="pemenang" aria-selected="false">
                        <i class="fas fa-trophy"></i> Pemenang
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="pengumuman" role="tabpanel" aria-labelledby="pengumuman-tab">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 20%;">Kode Tender</th>
                                    <td>21445999</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Tender</th>
                                    <td>Uji Coba Paket IHSS ke 3</td>
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
                                    <th scope="row">Uraian Singkat Pekerjaan</th>
                                    <td><a href="#">Peraturan Lembaga Nomor 5 Tahun 2021</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Pembuatan</th>
                                    <td>6 September 2024</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahap Tender Saat Ini</th>
                                    <td><a href="#">Pengumuman Pascakualifikasi</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">K/L/PD/Instansi Lainnya</th>
                                    <td>Kota Tegal</td>
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
                                    <th scope="row">Nilai HPS Paket</th>
                                    <td>Rp. 19.980.000.000,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kontrak</th>
                                    <td>Lumsum</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lokasi Pekerjaan</th>
                                    <td>RSUD Kardinah Kota Tegal - Tegal (Kota)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kualifikasi Usaha</th>
                                    <td>Non Kecil</td>
                                </tr>
                                <tr>
                                    <th scope="row">Peserta Tender</th>
                                    <td>3 Peserta</td>
                                </tr>
                                <!-- <tr>
                  <th scope="row">Syarat Kualifikasi</th>
                  <td>
                    <ul>
                      <li>Memenuhi ketentuan perundang-undangan untuk menjalankan kegiatan/usaha.</li>
                    </ul>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Jenis Izin</th>
                          <th>Bidang Usaha/Sub Bidang Usaha/Klasifikasi/Sub Klasifikasi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>NIB</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>Surat Izin</td>
                          <td>-</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="peserta" role="tabpanel" aria-labelledby="peserta-tab">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>NPWP</th>
                                <th>Harga Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>PT. lkpp penyedia 17</td>
                                <td>11.017.111.1-111.017</td>
                                <td>Rp. 777.000,00</td>
                            </tr>
                            <!-- ... (other rows) ... -->
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="evaluasi" role="tabpanel" aria-labelledby="evaluasi-tab">
                    <p class="text-muted">Data hasil evaluasi belum tersedia.</p>
                </div>
                <div class="tab-pane fade" id="pemenang" role="tabpanel" aria-labelledby="pemenang-tab">
                    <p class="text-muted">Data pemenang belum tersedia.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection