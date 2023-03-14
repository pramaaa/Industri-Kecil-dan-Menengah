@extends('layout.template')
@section('title', 'Pilih Komoditi')

@section('content')
    @if (Session::has('message'))
        <p class="alert alert-danger">{{ Session::get('message') }}</p>
    @endif

    <div class="card text-sm">
        <div class="card-body">
            <form name="pemilihan" action="/perhitungan" method="post" onsubmit="return validasiKomoditi()">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="komoditi">Pilih Komoditi</label>
                    <select class="form-control select2" style="width: 100%;" name="komoditi_id" id="komoditi_id">
                        @foreach ($komoditi as $k)
                            <option value="{{ $k->id_komoditi }}">{{ $k->nama_komoditi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary mx-auto d-block" type="submit" value="Hitung">
                </div>
            </form>
        </div>
    </div>

@endsection
