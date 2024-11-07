@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="font-bold text-3xl text-gray-800">Paket Details</h1>
        <a href="{{ route('admin/products') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
    <hr class="mb-6" />

    <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800 dark:text-gray-300">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold leading-6 text-gray-700 dark:text-gray-400">Nama Paket</label>
                <p class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ $product->nama_paket }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin/products/edit', $product->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md">
                <i class="bi bi-pencil-square mr-2"></i>Edit
            </a>
            <form action="{{ route('admin/products/destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                    <i class="bi bi-trash-fill mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
