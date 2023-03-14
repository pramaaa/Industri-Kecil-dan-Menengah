@extends('layout.template')
@section('title','Ganti Password')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                   
                        {{-- menampilkan error validasi --}}
                        @if (count($errors) > 5)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- form validasi -->
                        <form name="formulirpw" action="/repass" method="post" onsubmit="return validasiPW()">
                            {{ csrf_field() }}
 
                            <div class="form-group">
                                <label for="old_pw">Password lama</label>
                                <input class="form-control" type="password" name="old_pw" maxlength="40" value="">
                            </div>
                            @error("old_pw")
                            <div class="text-danger mt-2 text-sm">{{ $message }}<br></div>
                            @enderror
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input class="form-control" type="password" name="password" maxlength="50" value="">
                            </div>
                            @error("password")
                            <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input class="form-control" type="password" name="password_confirmation" maxlength="40" value="">
                            </div>
                            @error("password_confirmation")
                            <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <input class="btn btn-primary mx-auto d-block" type="submit" value="Ganti Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection