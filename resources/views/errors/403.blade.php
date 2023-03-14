@extends('layout.template')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

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