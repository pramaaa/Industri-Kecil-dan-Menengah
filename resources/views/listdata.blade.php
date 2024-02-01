@extends('layout.template')
@section('title', 'Data Industri kecil dan menengah')

@section('content')

    <div class="card text-sm">
        <div class="card-body">

            <a href="/industri/export_excel" class="btn btn-success my-3" target="_blank"><i class="fa fa-download"> Unduh
                    Format Excel</i></a> &nbsp;
            <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#importExcel">
                <i class="fa fa-upload"> Import File Excel </i></button>&nbsp;&nbsp;
            <a href="#" class="btn btn-danger my-3 deleteall" target=""><i class="fa fa-trash"> Hapus Seluruh
                    Data</i></a>
            <a href="/listdata" class="btn btn-link"><i class="fa fa-refresh fa-spin"></i> Refresh</a>
            <a href="/form-input" class="btn btn-link"><i class="fa fa-plus-square"></i> Tambah IKM Baru</a>

            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="/industri/import_excel" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <label>Pilih file excel sesuai format</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <form action="carikan" method="GET">
                <input class="form-control" type="text" name="nama" placeholder="Cari Industri .."
                    value="{{ old('cari') }}">
            </form>
            <br>
            <form action="perkomoditi" method="get">
                <select class="form-control select2" name="komoditi_id" id="komoditi_id" onchange="this.form.submit()">
                    @if ($k != 'x')
                        <option value="{{ $komoditi[$komoditi_id] }}">{{ $komoditi[$komoditi_id]->nama_komoditi }}</option>
                    @endif
                    <option value="">Seluruh Data</option>
                    @foreach ($komoditi as $k)
                        <option value="{{ $k->id_komoditi }}">{{ $k->nama_komoditi }}</option>
                    @endforeach
                </select>
            </form>

            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Industri</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Tenaga Kerja</th>
                        <th>Kapasitas Produksi</th>
                        <th>Nilai Investasi <br></th>
                        <th>Komoditi</th>
                        <th width="100px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = ($industri->currentpage() - 1) * $industri->perpage() + 1; ?>
                    @foreach ($industri as $i)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $i->nama_industri }}</td>
                            <td>{{ $i->nama_pemilik }}</td>
                            <td>{{ $i->alamat }}</td>
                            <td>{{ $i->telp }}</td>
                            <td>{{ $i->tenaga_kerja }}</td>
                            <td>{{ $i->kapasitas_produksi }}</td>
                            <td>Rp. {{ number_format($i->nilai_investasi, 2, ',', '.') }}</td>
                            <td>{{ $i->komoditi->nama_komoditi }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="/industri/{{ $i->id_industri }}/edit"><i
                                        class="fa fa-edit"style="font-size:15px"></i></a>
                                <a class="btn btn-danger btn-sm delete" data-id="{{ $i->id_industri }}"
                                    data-nama="{{ $i->nama_industri }}" href="#"><i class="fa fa-trash"
                                        style="font-size:15px"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <div class="pagination justify-content-center">
                <link rel="stylesheet" href="/css/app.css">{{ $industri->links() }}</link>
            </div>

            <br>
            Halaman : {{ $industri->currentPage() }} <br />
            Jumlah Data : {{ $industri->total() }} <br />
            <!--Data Per Halaman : {{ $industri->perPage() }} <br/></-->

        </div>
    </div>


@endsection
