@extends('layout.template')
@section('title','Menentukan Bobot Kriteria')

@section('content')

@if(Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<?php   use \App\Http\Controllers\AhpController; ?>

@if($autosubmit!=1)
<div class="card collapsed-card">
	
	<div class="card-header">
    <h3 class="card-title"></h3>
    Tabel Tingkat Kepentingan menurut Saaty (1980)
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-plus"></i>
      </button>
    </div>     
  </div>
  
  <div class="card-body">
    <table>
			<thead>
				<tr>
					<th>Nilai Numerik</th>
					<th>Tingkat Kepentingan <em>(Preference)</em></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="center aligned">1</td>
					<td>Sama pentingnya <em>(Equal Importance)</em></td>
				</tr>
				<tr>
					<td class="center aligned">2</td>
					<td>Sama hingga sedikit lebih penting</td>
				</tr>
				<tr>
					<td class="center aligned">3</td>
					<td>Sedikit lebih penting <em>(Slightly more importance)</em></td>
				</tr>
				<tr>
					<td class="center aligned">4</td>
					<td>Sedikit lebih hingga jelas lebih penting</td>
				</tr>
				<tr>
					<td class="center aligned">5</td>
					<td>Jelas lebih penting <em>(Materially more importance)</em></td>
				</tr>
				<tr>
					<td class="center aligned">6</td>
					<td>Jelas hingga sangat jelas lebih penting</td>
				</tr>
				<tr>
					<td class="center aligned">7</td>
					<td>Sangat jelas lebih penting <em>(Significantly more importance)</em></td>
				</tr>
				<tr>
					<td class="center aligned">8</td>
					<td>Sangat jelas hingga mutlak lebih penting</td>
				</tr>
				<tr>
					<td class="center aligned">9</td>
					<td>Mutlak lebih penting <em>(Absolutely more importance)</em></td>
				</tr>
			</tbody>
		</table>
  </div>
</div>@endif

<div class="card text-sm @if($autosubmit==1) collapsed-card @endif">
	<div class="card-body">
		<div class="col" >
      <div class="card">
        <div class="card-header">
          <div class="mid"><b>Bobot kriteria</b></div>
        </div>
        <table class="table">
        	<thead>
        		<tr>
        			@foreach($kriteria as $k)
							<th class="mid">{{ $k->nama_kriteria }}</th>
							@endforeach
						</tr>
         	</thead>
         	<tfoot>
         		<tr>
         			@foreach($kriteria as $k)
							<td class="mid">{{ $k->w }}</td>
							@endforeach
         		</tr>
         	</tfoot>
        </table>
      </div>
    </div>
	</div>
</div>

<div class="card text-sm @if($autosubmit==1) collapsed-card @endif">
	<div class="card-body">
		<div id="cara" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg" style="min-width:90%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><b>Cara mengelola bobot</b></h4>	
          </div>
					<div class="tutor">
      			<p>
      				<img src="{{ asset('img') }}/bobot.jpg" alt="bobot">
      				<br>Tabel tersebut menampilkan nilai bobot setiap kriteria<br>
      				<br>1. Pilih kriteria yang lebih penting.
      				<br><img src="{{ asset('img') }}/pilihbobot.jpg" alt="bobot"><br>
      				<br>2. Tentukan nilai perbedaan kepentingannya.
      				<br><img src="{{ asset('img') }}/nilaibb.jpg" alt="bobot"><br>
              <br>3. Tekan tombol "Proses Matriks Perbandingan" untuk menuju langkah berikutnya.
      			</p>
    			</div>
  			</div>
  		</div>
  	</div>
  	<div class="text-right bw">
    	<button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#cara">?</button>
    </div>
		<form name="penentuan_bobot" id="penentuan_bobot" class="ui form" action="matriks_p" method="post">
		 	@csrf
		 	@if($bypass==1)
		 	<input type="hidden" name="bypass" value="1"> <br/>
		 	@else
		 	<input type="hidden" name="bypass" value="0"> <br/>
		 	@endif
			<table class="ui celled selectable collapsing table">
				<thead>
					<tr>
						<th class="text-center" colspan="2">Pilih yang lebih penting</th>
						<th>Nilai perbandingan</th>
					</tr>
				</thead>
				<tbody>

					<?php $urut = 0; ?>
					@for ($x=0; $x <= 1; $x++)
						@for ($y=($x+1); $y <= 2; $y++)
							<?php 
								$urut++;
								$nilai_bp = AhpController::getNilaiBP($x,$y); 
							?>
							<tr>
								<td>
									<div class="field">
										<div class="text-center">
											<input name="pilih{{ $urut }}" value="1" checked="" type="radio">
											<label>{{ $kriteria[$x]->nama_kriteria }}</label>
										</div>
									</div>
								</td>
								<td>
									<div class="field">
										<div class="text-center">
											<input name="pilih{{ $urut }}" value="2" 
											@if($nilai_bp == "0.111111" || 
											$nilai_bp == "0.125000" || 
											$nilai_bp == "0.142857" ||
											$nilai_bp == "0.166667" ||
											$nilai_bp == "0.200000" ||
											$nilai_bp == "0.250000" ||
											$nilai_bp == "0.333333" ||
											$nilai_bp == "0.500000") 
											checked="" @endif type="radio">
											<label>{{ $kriteria[$y]->nama_kriteria }}</label>
										</div>
									</div>
								</td>
								<td>
									<div class="field">
										<!--input type="text" name="bobot{{ $urut }}" value="{{ $nilai_bp }}" required-->
										<select class="form-control select2" name="bobot{{ $urut }}" style="width: 100%;">
                      <option value="1" @if($nilai_bp == "1") selected="selected" @endif>Sama penting</option>
                      <option value="2" @if($nilai_bp == "2" || $nilai_bp == "0.500000") selected="selected" @endif>2 kali lebih penting</option>
                      <option value="3" @if($nilai_bp == "3" || $nilai_bp == "0.333333") selected="selected" @endif>3 kali lebih penting</option>
                      <option value="4" @if($nilai_bp == "4" || $nilai_bp == "0.250000") selected="selected" @endif>4 kali lebih penting</option>
                      <option value="5" @if($nilai_bp == "5" || $nilai_bp == "0.200000") selected="selected" @endif>5 kali lebih penting</option>
                      <option value="6" @if($nilai_bp == "6" || $nilai_bp == "0.166667") selected="selected" @endif>6 kali lebih penting</option>
                      <option value="7" @if($nilai_bp == "7" || $nilai_bp == "0.142857") selected="selected" @endif>7 kali lebih penting</option>
                      <option value="8" @if($nilai_bp == "8" || $nilai_bp == "0.125000") selected="selected" @endif>8 kali lebih penting</option>
                      <option value="9" @if($nilai_bp == "9" || $nilai_bp == "0.111111") selected="selected" @endif>9 kali lebih penting</option>
                    </select>
									</div>
								</td>
							</tr>		
						@endfor
				@endfor
					
				</tbody>
			</table>
			<div class="form-group">
    		@if($autosubmit==0)
    			<input class="btn btn-primary mx-auto d-block" type="submit" name="submit" value="Proses Matriks Perbandingan">
    		@endif
  		</div>
		</form>
	</div>
</div>

@endsection