@extends('layout.template')
@section('title','Matriks Perbandingan Bobot Kriteria')

@section('content')
@if(Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<div class="card text-sm">
	<div class="card-body">
		A
	</div>
</div>

@endsection