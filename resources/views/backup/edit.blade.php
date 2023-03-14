@extends('layout.template')
@section('title','Mengubah Data Industri')

@section('content')
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
 
                        {{-- menampilkan error validasi --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                  
                        <!-- form validasi -->
                        <form name="formulir" action="/industri/update/" method="post" onsubmit="return validasiForm()">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $i->id_industri }}"> <br/>
                            <div class="form-group">
                                <label for="nama_industri">Nama Industri</label>
                                <input class="form-control" type="text" name="nama_industri" maxlength="40" value="{{ $i->nama_industri }}">
                            </div>
                            @if($errors->has('nama_industri'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_industri')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input class="form-control" type="text" name="nama_pemilik" maxlength="50" value="{{ $i->nama_pemilik }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4" cols="60" maxlength="90">{{ $i->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="telp">Nomor Telepon</label>
                                <input class="form-control" type="text" name="telp" maxlength="15" value="{{ $i->telp }}">
                            </div>
                            <div class="form-group">
                                <label for="tenaga_kerja">Jumlah Tenaga Kerja</label>
                                <input class="form-control" type="text" name="tenaga_kerja" value="{{ $i->tenaga_kerja }}">
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_produksi">Kapasitas Produksi</label>
                                <input class="form-control" type="number" name="kapasitas_produksi" min="1" max="10000000" value="{{ $i->kapasitas_produksi }}">
                            </div>
                            <div class="form-group">
                                <label for="nilai_investasi">Nilai Investasi (Tanpa titik)</label>
                                <input class="form-control" type="number" name="nilai_investasi" min="1" max="10000000" value="{{ $i->nilai_investasi }}">
                            </div>
                            <div class="form-group">
                                <label for="komoditi">Komoditi</label>
                                <select class="form-control select2" style="width: 100%;" name="komoditi_id" id="komoditi_id">
                                    <option value="{{ $i->komoditi_id }}">{{ $i->komoditi->nama_komoditi }}</option>
                                    @foreach ($komoditi as $k)
                                        <option value="{{ $k->id_komoditi }}">{{ $k->nama_komoditi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary mx-auto d-block" type="submit" value="Perbarui">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection