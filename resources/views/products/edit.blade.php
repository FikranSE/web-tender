@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-3xl text-gray-800">Edit paket</h1>
            <a href="{{ route('admin/products') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
        <hr class="mb-6" />
        @if (Session::has('error'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <form action="{{ route('admin/products/update', $product->id_paket) }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <!-- Title -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="title"
                        class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nama Paket</label>
                    <input type="text" name="nama_paket" id="title" value="{{ $product->nama_paket }}"
                        class="mt-2 block w-full rounded-md border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>


            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                    <i class="bi bi-check2-circle mr-2"></i>Update Paket
                </button>
            </div>
        </form>
    </div>
@endsection
