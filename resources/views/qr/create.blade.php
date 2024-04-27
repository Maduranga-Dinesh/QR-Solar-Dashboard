@extends('layouts.app')

@section('title', 'Create QR')

@section('contents')
<div class="flex justify-center">
    <h1 class="font-bold text-2xl">Add New QR ID</h1>
</div>

<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"></div>

<div class="mx-auto w-1/4 shadow-lg p-5">
    <form action="{{ route('admin/qr/store') }}" method="POST" enctype="multipart/form-data" id="qr_form">
        @csrf
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">QR ID</label>
            <div class="mt-2 flex justify-center">
                <input type="text" placeholder="Ex : 7021465471" name="qr_id" id="qr_id" pattern="\d{10}" title="Please enter 10 digits" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
            </div>
            <div class="mt-1 flex justify-center">
                <span id="remaining_count" class="text-gray-500"></span>
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Time</label>
            <div class="mt-2">
                <input id="time" placeholder="Minutes" name="time" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
            <div class="mt-2">
                <input id="amount" placeholder="Rs" name="amount" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
            </div>
        </div>
        <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </form>
</div>

<script>
    document.getElementById('qr_form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        let qrId = document.getElementById('qr_id').value;
        let time = document.getElementById('time').value;
        let amount = document.getElementById('amount').value;

        // Check if first two digits of QR ID match time and next two digits match amount
        let qrTime = qrId.substring(0, 2);
        let qrAmount = qrId.substring(2, 4);

        if (qrTime !== time || qrAmount !== amount) {
            alert("Error: QR ID does not match Time or Amount values.");
        } else {
            this.submit(); // Submit the form if validation passes
        }
    });
</script>
<script>
    document.getElementById('qr_id').addEventListener('input', function(event) {
        let value = event.target.value;
        let remainingCount = 10 - value.length;
        document.getElementById('remaining_count').textContent = remainingCount > 0 ? remainingCount + " remaining" : "All numbers entered";
    });
</script>
@endsection
