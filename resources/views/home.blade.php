@extends('layouts.user')

@section('title', 'Home')

@section('contents')
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
        .full-screen-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover; /* This maintains the aspect ratio while filling the viewport */
        }
    </style>
    <img src="https://i.ibb.co/XbSJy74/image.png" alt="image" class="full-screen-image">
@endsection
