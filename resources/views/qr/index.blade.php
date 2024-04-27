@extends('layouts.app')

@section('title', 'QR List')

@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">QR ID List</h1>
    <a href="{{ route('admin/qr/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add QR ID</a>
    <hr />

    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="w-36">
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">QR ID</th>
                <th scope="col" class="px-6 py-3">Duration</th>
                <th scope="col" class="px-6 py-3">Amount</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Date and Time</th>
            </tr>
        </thead>

        <tbody>
            @if($qr->count() > 0)
            @foreach($qr as $rs)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                {{-- <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->iteration }}
                </th> --}}
                <td >
                    {{ $rs->id }}
                </td>
                <td>
                    {{ $rs->qr_id }}
                </td>
                <td>
                    {{ $rs->time }}
                </td>
                <td>
                    {{ $rs->amount }}
                </td>
                <td>
                    {{ $rs->status }}
                </td>
                <td>
                    {{ $rs->created_at }}
                </td>
                <td class="w-36">
                    <div class="h-14 pt-5">
                        {{-- <a href="{{ route('admin/qr/show', $rs->id) }}" class="text-blue-800">Detail</a> | --}}
                        <a href="{{ route('admin/qr/edit', $rs->id)}}" class="text-green-800 pl-16">Edit</a> |
                        <form action="{{ route('admin/qr/destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">Data not found</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
