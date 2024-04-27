@extends('layouts.app')

@section('title', 'Profile Settings')

@section('contents')
<div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Update Profile</h1>
    <hr class="mb-6">
    <form method="POST" enctype="multipart/form-data" action="">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" class="mt-1 p-2 w-full border rounded-md">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" class="mt-1 p-2 w-full border rounded-md">
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Profile</button>
        </div>
    </form>
</div>
@endsection
