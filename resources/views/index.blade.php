@extends('layouts.user')

@section('title', 'Home')

@section('contents')

    <main>
        <div class="container-fluid py-5">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-start mb-4 text-2xl font-semibold">Daftar Tender Terbaru</h2>

                @php
                    // Kelompokkan tender berdasarkan id_paket
                    $groupedTenders = $tenders->groupBy('id_paket');
                @endphp

                @foreach ($groupedTenders as $paketId => $group)
                    @if ($group->first()->paket)
                        <div class="tender-card border border-gray-300 rounded-lg p-4 shadow-md">
                            <!-- Menampilkan nama paket -->
                            <div class="tender-header mb-4">
                                <h4 class="mb-0 text-lg font-bold">{{ $group->first()->paket->nama_paket }}</h4>
                            </div>

                            <div class="tender-body">
                                @foreach ($group as $td)
                                    <div
                                        class="tender-item mb-4 p-4 border border-gray-200 rounded-md hover:shadow-lg transition-shadow">
                                        <h5 class="tender-subtitle text-md font-semibold">{{ $td->nama_tender }}</h5>
                                        <div class="row tender-info mt-2">
                                            <div class="col-md-3 mb-2">
                                                <i class="fas fa-tag"></i> <strong>Kode Tender:</strong>
                                                {{ $td->kode_tender }}
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <i class="fas fa-money-bill-wave"></i> <strong>HPS:</strong> Rp.
                                                102.000.000,00
                                            </div>
                                            <div class="col-md-5 mb-2">
                                                <i class="fas fa-calendar-alt"></i> <strong>Batas Akhir:</strong>
                                                {{ $td->tanggal_selesai }}
                                            </div>
                                        </div>
                                        <div class="text-end mt-4">
                                            <a href="detailTender" class="btn btn-detail"
                                                style="background-color: #17a2b8; color: white; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s;">Lihat
                                                Detail <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </main>

@endsection
