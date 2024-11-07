@extends('layouts.app')

@section('title', 'Home Product List')

@section('contents')
    <style>
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .hover\:animate-pulse:hover {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-3xl text-gray-800">Home Paket List</h1>
            <a href="{{ route('admin/tender/create') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-plus-lg"></i> Add Paket
            </a>
        </div>
        <hr class="mb-4" />

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Kode tender</th>
                        <th scope="col" class="px-6 py-3">Nama tender</th>
                        <th scope="col" class="px-6 py-3">Tahap saat ini</th>
                        <th scope="col" class="px-6 py-3">Tanggal mulai</th>
                        <th scope="col" class="px-6 py-3">Tanggal selesai</th>
                        <th scope="col" class="px-6 py-3">Dokumen pemulihan</th>
                        <th scope="col" class="px-6 py-3">Berita acara</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @if ($tenders->count() > 0)
                        @foreach ($tenders as $tender)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tender->kode_tender }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tender->nama_tender }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tender->tahapan_tender_saat_ini }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tender->tanggal_mulai }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tender->tanggal_selesai }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($tender->dokumen_pemilihan)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.tender.downloadDocPem', ['tender' => $tender->id_tender]) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition ease-in-out duration-150">
                                                Download
                                            </a>
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($tender->berita_acara)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.tender.downloadBerita', ['tender' => $tender->id_tender]) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition ease-in-out duration-150">
                                                Download
                                            </a>
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @switch($tender->status)
                                        @case('draft')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Draft
                                            </span>
                                        @break

                                        @case('aktif')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        @break

                                        @case('selesai')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Selesai
                                            </span>
                                        @break

                                        @case('dibatalkan')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Dibatalkan
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $tender->status }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <div class="flex justify-center items-center w-full">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin/tender/edit', $tender->id_tender) }}"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150"
                                                title="Edit Tender">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin/tender/destroy', $tender->id_tender) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this tender?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150"
                                                    title="Delete Tender">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center py-4 text-gray-600 dark:text-gray-300" colspan="9">
                                No tenders found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
