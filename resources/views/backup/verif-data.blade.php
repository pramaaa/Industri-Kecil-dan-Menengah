<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Industri</title>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3></h3>
                        <h3 class="my-4">Data Yang Di Input : </h3>
 
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width:150px">Nama Industri</td>
                                <td>{{ $data->nama_industri }}</td>
                            </tr>
                            <tr>
                                <td>Nama Produk</td>
                                <td>{{ $data->produk }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Tenaga Kerja</td>
                                <td>{{ $data->tenaga_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Produksi</td>
                                <td>{{ $data->kapasitas_produksi }}</td>
                            </tr>
                            <tr>
                                <td>Satuan Produksi</td>
                                <td>{{ $data->satuan_produksi }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Investasi</td>
                                <td>{{ $data->nilai_investasi }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Produksi</td>
                                <td>{{ $data->nilai_produksi }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Bahan Baku</td>
                                <td>{{ $data->nilai_bahanbaku }}</td>
                            </tr>
                            <tr>
                                <td>Komoditi</td>
                                <td>{{ $data->komoditi }}</td>
                            </tr>
                        </table>
 
                        <a href="/listdata" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</body>
</html>