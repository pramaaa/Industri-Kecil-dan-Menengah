@extends('layout.template')
@section('title', 'Perhitungan Alternatif')

@section('content')
    @if (Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif

    @include('2_proses')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ranking {{ $nama_komoditi }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#proses">Tampilkan
                    Proses Perhitungan</button>
            </div>
        </div>

        <div class="card-body">
            <table class="ui collapsing celled blue table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Alternatif</th>
                        <th>Nama Industri</th>
                        <th>Nama Pemilik</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($x = 0; $x < $jumlah; $x++)
                        <tr>
                            <td>{{ $x + 1 }}</td>
                            @for ($y = 0; $y <= 3; $y++)
                                @if ($y == 0)
                                    <td>A{{ $m_rank[$x][$y] }}</td>
                                @elseif($y == 1 || $y == 2)
                                    <td>{{ $m_rank[$x][$y] }}</td>
                                @else
                                    <td>{{ round($m_rank[$x][$y], 5) }}</td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

@endsection
