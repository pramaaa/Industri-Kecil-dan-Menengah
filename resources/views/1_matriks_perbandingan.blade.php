@extends('layout.template')
@section('title','Matriks Perbandingan Bobot Kriteria')

@section('content')
@if(Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<div class="card text-sm">
	<div class="card-body">
		<h3 class="ui header">Matriks Perbandingan Berpasangan</h3>
		<table class="ui collapsing celled blue table ">
			<thead>
				<tr>
					<th>Kriteria</th>
					@for ($i=0; $i <= 2; $i++)
						<th>{{ $kriteria[$i]->nama_kriteria }}</th>
					@endfor
				</tr>
			</thead>
			<tbody>
				@for ($x=0; $x <= 2; $x++) 
					<tr>
						<td> {{ $kriteria[$x]->nama_kriteria }} </td>
						@for ($y=0; $y <= 2; $y++) 
							<td> {{ round($matrik[$x][$y],5) }} </td>
						@endfor
					</tr>
				@endfor
			</tbody>
			<tfoot>
				<tr>
					<th>Jumlah</th>
					@for ($i=0; $i <= 2; $i++)
						<th>{{ round($jml_m1[$i],5) }}</th>
					@endfor
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<div class="card text-sm">
	<div class="card-body">
		<h3 class="ui header">Matriks Nilai Kriteria</h3>
		<table class="ui celled red table">
			<thead>
				<tr>
					<th>Kriteria</th>
					@for ($i=0; $i <= 2; $i++) 
						<th>{{ $kriteria[$i]->nama_kriteria }}</th>
					@endfor
					<th>Jumlah</th>
					<th>Priority Vector</th>
				</tr>
			</thead>
			<tbody>
				@for ($x=0; $x <= 2; $x++)
					<tr>
						<td>{{ $kriteria[$x]->nama_kriteria }}</td>
						@for ($y=0; $y <= 2; $y++) 
							<td>{{ round($matrik_2[$x][$y],5) }}</td>
						@endfor

						<td>{{ round($jml_m2[$x],5) }}</td>
						<td>{{ round($w[$x],5) }}</td>
					</tr>
				@endfor
			</tbody>
			<tfoot>
				<tr>
					<th colspan="5">Principe Eigen Vector (λ maks)</th>
					<th>{{ round($ev,5) }}</th>
				</tr>
				<tr>
					<th colspan="5">Consistency Index</th>
					<th>{{ round($CI,5) }}</th>
				</tr>
				<tr>
					<th colspan="5">Consistency Ratio</th>
					<th>{{ round($CR,5) }}</th>
				</tr>
			</tfoot>
		</table>
		@if($CR > 0.1)
			<div class="ui icon red message">
				<i class="close icon"></i>
				<i class="warning circle icon"></i>
				<div class="content">
					<div class="header">
						Nilai Consistency Ratio melebihi 0.1 !!!
					</div>
					<p>Mohon input kembali tabel perbandingan...</p>
				</div>
			</div>

			<br>

			<a href='javascript:history.back()'>
				<button class="ui left labeled icon button">
					<i class="left arrow icon"></i>
					Kembali
				</button>
			</a>
		@else
			<br>
			<form name="pilih_komoditi" id="pilih_komoditi" class="ui form" action="pilih_komoditi" method="post">
			@csrf
			@if($bypass==0)
    			<input class="btn btn-primary mx-auto d-block" type="submit" name="submit" value="Lanjut">
    		@endif
			
			</form>
		@endif
	</div>
	</div>
</div>

@endsection