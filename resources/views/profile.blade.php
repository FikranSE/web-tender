@extends('layouts.app')

@section('title', 'Admin Profile')

@section('contents')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Admin Profile</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin/profile/update') }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
            <input name="name" type="text" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
            <input name="email" type="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        </div>

        <!-- Password (Optional) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="password">Password (Optional)</label>
            <input name="password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2" for="password_confirmation">Confirm Password</label>
            <input name="password_confirmation" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        </div>

        <!-- Save Button -->
        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">
                Save Profile
            </button>
        </div>
    </form>
</div>
@endsection
