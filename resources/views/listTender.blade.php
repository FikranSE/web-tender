@extends('layouts.user')

@section('title', 'Home')

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

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #17a2b8;
            color: white;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .table th,
        .table td {
            border: none;
            padding: 12px;
        }

        .table th {
            background-color: #e9ecef;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
            font-size: 0.9em;
            margin-right: 5px;
        }

        .badge {
            font-size: 0.9em;
            padding: 5px 10px;
        }
    </style>



    <div class="container mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mx-3">
            <div class="row mb-3 d-flex justify-content-between">
                <div class="col-sm-2">
                    <select class="form-control" id="tampilanSelect">
                        <option value="25" selected>25 data</option>
                        <option value="50">50 data</option>
                        <option value="100">100 data</option>
                    </select>
                </div>
                <div class="col-md-6 text-right">
                    <input type="text" id="cari" class="form-control" placeholder="Cari Tender">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-file-contract"></i> Daftar Tender</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Tender</th>
                                <th>Nama Tender</th>
                                <th>Tahap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenders as $tender)
                                <tr>
                                    <td>{{ $tender->kode_tender }}</td>
                                    <td>
                                        <a href="{{ route('informasiTender', ['id' => $tender->id_tender]) }}"
                                            class="tender-link">{{ $tender->nama_tender }}</a>
                                        <span class="badge badge-info">Tender</span>
                                        <span class="badge badge-info">spse 4.5</span>
                                    </td>
                                    <td>{{ $tender->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
