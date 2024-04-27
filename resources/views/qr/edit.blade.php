@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
<div class="flex justify-center">
    <h1 class="font-bold text-2xl">Edit Product</h1>
</div>


    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

    </div>

    <div class="mx-auto w-1/4 shadow-lg p-5">

            <form action="{{ route('admin/qr/update', $qr->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">QR ID</label>
                    <div class="mt-2 flex justify-center">
                        <input type="text" name="qr_id" id="title" value="{{ $qr->qr_id }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                    <div class="mt-1 flex justify-center">
                        <span id="remaining_count" class="text-gray-500"></span>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                    <div class="mt-2">
                        <input id="price" name="value" type="text" value="{{ $qr->value }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </form>
    </div>

    <script>
        document.getElementById('qr_id').addEventListener('input', function(event) {
            let value = event.target.value;
            let remainingCount = 10 - value.length;
            document.getElementById('remaining_count').textContent = remainingCount > 0 ? remainingCount + " remaining" : "All numbers entered";
        });
    </script>

@endsection
