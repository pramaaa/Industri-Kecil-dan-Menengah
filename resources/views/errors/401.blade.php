@extends('layout.template')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

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