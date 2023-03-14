@extends('layout.template')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

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