<div >
	

    <div id="proses" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="min-width:90%;">
          	<div class="modal-content">
            	<div class="modal-header">
              		<h4 class="modal-title">Proses Perhitungan</h4>	
                </div>
                
				<div class="card collapsed-card">
					<div class="card-header">
				    	<h3 class="card-title"></h3>
				    	Matriks X (Jumlah Alternatif = {{ $jumlah }})
				    	<div class="card-tools">
				      		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				        		<i class="fas fa-plus"></i>
				      		</button>
				    	</div>     
				  	</div>
					<div class="card-body">
						<table class="ui collapsing celled blue table">
							<thead>
								<tr>
									<th>Alternatif</th>
									<th>Nama Industri</th>
									<th>Nama Pemilik</th>
									<th>Tenaga Kerja</th>
									<th>Kapasitas Produksi</th>
									<th>Nilai Investasi</th>
								</tr>
							</thead>
							<tbody>
								@for ($x=0; $x < $jumlah; $x++) 
									<tr>
										@for ($y=0; $y <= 4; $y++)
											@if($y==0)
												<td>A{{ $m_X[$x][6] }}</td>
											@elseif($y==2)
												<td>{{ $m_X[$x][5] }}</td>
												<td>{{ $m_X[$x][2] }}</td>
											@else
												<td>{{ $m_X[$x][$y] }}</td>
											@endif
										@endfor
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>

				<div class="card collapsed-card">
					<div class="card-header">
				    	<h3 class="card-title"></h3>
				    	Matriks Normalisasi Alternatif
				    	<div class="card-tools">
				      		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				        		<i class="fas fa-plus"></i>
				      		</button>
				    	</div>     
				  	</div>
					<div class="card-body">
						<table class="ui collapsing celled blue table">
							<thead>
								<tr>
									<th>Alternatif</th>
									<th>Nama Industri</th>
									<th>Nama Pemilik</th>
									<th>Tenaga Kerja</th>
									<th>Kapasitas Produksi</th>
									<th>Nilai Investasi</th>
								</tr>
							</thead>
							<tbody>
								@for ($x=0; $x < $jumlah; $x++) 
									<tr>
										@for ($y=0; $y <= 4; $y++)
											@if($y==0)
												<td>A{{ $m_X[$x][6] }}</td>
											@elseif($y==1)
												<td>{{ $m_normalisasi[$x][$y] }}</td>
											@elseif($y==2)
												<td>{{ $m_X[$x][5] }}</td>
												<td>{{ round($m_normalisasi[$x][2],5) }}</td>
											@else
												<td>{{ round($m_normalisasi[$x][$y],5) }}</td>
											@endif
										@endfor
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>

				<div class="card collapsed-card">
					<div class="card-header">
				    	<h3 class="card-title"></h3>
				    	Matriks Qi 1
				    	<div class="card-tools">
				      		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				        		<i class="fas fa-plus"></i>
				      		</button>
				    	</div>     
				  	</div>
					<div class="card-body">
						<table class="ui collapsing celled blue table">
							<thead>
								<tr>
									<th>Alternatif</th>
									<th>Nama Industri</th>
									<th>Nama Pemilik</th>
									<th>Tenaga Kerja</th>
									<th>Kapasitas Produksi</th>
									<th>Nilai Investasi</th>
									<th>Jumlah</th>
									<th>Nilai Qi 1</th>
								</tr>
							</thead>
							<tbody>
								@for ($x=0; $x < $jumlah; $x++) 
									<tr>
										@for ($y=0; $y <= 6; $y++)
											@if($y==0)
												<td>A{{ $m_X[$x][6] }}</td>
											@elseif($y==1)
												<td>{{ $m_Qi_1[$x][$y] }}</td>
											@elseif($y==2)
												<td>{{ $m_X[$x][5] }}</td>
												<td>{{ round($m_Qi_1[$x][2],5) }}</td>	
											@else
												<td>{{ round($m_Qi_1[$x][$y],5) }}</td>
											@endif
										@endfor
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>

				<div class="card collapsed-card">
					<div class="card-header">
				    	<h3 class="card-title"></h3>
				    	Matriks Qi 2
				    	<div class="card-tools">
				      		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				        		<i class="fas fa-plus"></i>
				      		</button>
				    	</div>     
				  	</div>
					<div class="card-body">
						<table class="ui collapsing celled blue table">
							<thead>
								<tr>
									<th>Alternatif</th>
									<th>Nama Industri</th>
									<th>Nama Pemilik</th>
									<th>Tenaga Kerja</th>
									<th>Kapasitas Produksi</th>
									<th>Nilai Investasi</th>
									<th>Perkalian</th>
									<th>Nilai Qi 2</th>
								</tr>
							</thead>
							<tbody>
								@for ($x=0; $x < $jumlah; $x++) 
									<tr>
										@for ($y=0; $y <= 6; $y++)
											@if($y==0)
												<td>A{{ $m_X[$x][6] }}</td>
											@elseif($y==1)
												<td>{{ $m_Qi_2[$x][$y] }}</td>
											@elseif($y==2)
												<td>{{ $m_X[$x][5] }}</td>
												<td>{{ round($m_Qi_2[$x][2],5) }}</td>	
											@else
												<td>{{ round($m_Qi_2[$x][$y],5) }}</td>
											@endif
										@endfor
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>

				<div class="card collapsed-card">
					<div class="card-header">
				    	<h3 class="card-title"></h3>
				    	Matriks Qi
				    	<div class="card-tools">
				      		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				        		<i class="fas fa-plus"></i>
				      		</button>
				    	</div>     
				  	</div>
					<div class="card-body">
						<table class="ui collapsing celled blue table">
							<thead>
								<tr>
									<th>Alternatif</th>
									<th>Nama Industri</th>
									<th>Nama Pemilik</th>
									<th>Nilai Qi</th>
								</tr>
							</thead>
							<tbody>
								@for ($x=0; $x < $jumlah; $x++) 
									<tr>
										@for ($y=0; $y <= 2; $y++)
											@if($y==0)
												<td>A{{ $m_X[$x][6] }}</td>
											@elseif($y==1)
												<td>{{ $m_Qi[$x][$y] }}</td>
											@elseif($y==2)
												<td>{{ $m_X[$x][5] }}</td>
												<td>{{ round($m_Qi[$x][2],5) }}</td>	
											@else
												<td>{{ round($m_Qi[$x][$y],5) }}</td>
											@endif
										@endfor
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
                

            </div>
    	</div>
    </div>
</div>


