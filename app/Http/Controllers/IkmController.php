<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Industri;
use App\Komoditi;
use App\Exports\IndustriExport;
use App\Imports\IndustriImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IkmController extends Controller
{

    public function index()
    {
        //$industri = DB::table('industri')->get();                             // Cara QueryBuilder -> menggunakan "DB"
        //$industri = Industri::all();                                          // Cara Eloquent     -> menggunakan "Model"
        //$industri = DB::table('industri')->paginate(10);

        $k="x";
        $komoditi = Komoditi::all();
        $industri = Industri::with('komoditi')->paginate(10);                   // Select * industri join komoditi
                                                         // Paginate(10) = 10 Data perhalaman
        //return view('listdata',['industri' => $industri]);
        return view('listdata',compact('industri','komoditi','k'));
    }

    public function cari(Request $request)
    {
        $nama = $request->nama;

        $k="x";
        $komoditi = Komoditi::all();
        $industri = Industri::with('komoditi')                                  // Select * Industri join Komoditi
        ->where('nama_industri','like',"%".$nama."%")                           // where
        ->orwhere('nama_pemilik','like',"%".$nama."%")
        ->paginate(10);

        return view('listdata',compact('industri','komoditi','komoditi_id','k'));
    }

    public function selectkomoditi(Request $request)
    {
        $komoditi_id = $request->komoditi_id;

        $komoditi = Komoditi::all();
        $industri = Industri::with('komoditi')                                  // Select * Industri join Komoditi
        ->where('komoditi_id',$komoditi_id)                           // where
        ->paginate(10);
        $industri->appends(['komoditi_id' => $komoditi_id]);
        $k=$komoditi_id;
        if($komoditi_id == "")
            $k="x";
        return view('listdata',compact('industri','komoditi','komoditi_id','k'));
    }


    public function inputform()
    {
        $komoditi = Komoditi::all();                                            // Select * Komoditi
        $edit=false;
        return view('form',compact('komoditi','edit'));

    }

    // method untuk insert data ke table industri
    public function tambah(Request $request)
    {
        // Proses database
        DB::table('industri')->insert([                                         // Insert into Industri
            'nama_industri' => $request->nama_industri,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'tenaga_kerja' => $request->tenaga_kerja,
            'kapasitas_produksi' => $request->kapasitas_produksi,
            'nilai_investasi' => $request->nilai_investasi,
            'komoditi_id' => $request->komoditi_id,
        ]);

        //return view('verif-data',['data' => $request]);
        return redirect('/listdata')->with('success', 'Berhasil menambahkan IKM '.$request->nama_industri.'');
    }

    // method untuk memanggil view edit data industri
    public function editform($id)
    {
        $komoditi = Komoditi::all();
        $i = Industri::find($id);                                               // Select id Industri where $id
        $edit=true;
        return view('form',compact('i','komoditi','edit'));

    }

    // update data industri
    public function perbarui(Request $request)
    {
        // update data industri
        DB::table('industri')->where('id_industri',$request->id)->update([      // Update Industri set ... where ...
            'nama_industri' => $request->nama_industri,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'tenaga_kerja' => $request->tenaga_kerja,
            'kapasitas_produksi' => $request->kapasitas_produksi,
            'nilai_investasi' => $request->nilai_investasi,
            'komoditi_id' => $request->komoditi_id,
        ]);

        return redirect('/listdata')->with('success', 'Berhasil memperbarui IKM '.$request->nama_industri.'');
    }

    // method untuk hapus data industri
    public function hapus($id)
    {
        $industri = Industri::find($id);                                        // Select id Industri where $id
        $nama = $industri->nama_industri;
        $industri->delete();                                                    // Delete from Industri

        return redirect('/listdata')->with('success', 'Berhasil menghapus IKM '.$nama.'');
    }

    public function format()
    {
        Industri::truncate();

        return redirect('/listdata')->with('success', 'Berhasil menghapus seluruh data IKM');
    }

    // method untuk export data
    public function excel_export()
    {
        return Excel::download(new IndustriExport, 'industri.xlsx');            // Query Download Export
    }

    public function excel_import(Request $request)
    {
        $cekjenisfile = Validator::make($request->all(),[
            'file' => ['required','mimes:csv,xls,xlsx'],
        ]);

        if ($cekjenisfile->fails()) {

            return redirect('/listdata')->with('error', 'Gagal menambahkan  melalui fitur import, pastikan file sesuai format');
        }
        else{

            // menangkap file excel
            $file = $request->file('file');                                         // Query Upload

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder data_industri di dalam folder public
            $file->move('data_industri',$nama_file);

            // import data
            Excel::import(new IndustriImport, public_path('/data_industri/'.$nama_file));   // Query Import

            // alihkan halaman kembali
            return redirect('/listdata')->with('success', 'Berhasil menambahkan  melalui fitur import');
        }
    }

}
