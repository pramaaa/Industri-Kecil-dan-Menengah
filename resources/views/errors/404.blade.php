@extends('layout.template')

@section('title', __('Halaman tidak ditemukan'))
@section('code', '404')
@section('message', __('Halaman tidak ditemukan'))

@section('content')
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message2" style="padding: 10px;">
                @yield('message')
            </div>
        </div>
@endsection