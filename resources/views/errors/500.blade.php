@extends('layout.template')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

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