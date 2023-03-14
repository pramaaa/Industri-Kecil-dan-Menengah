<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Industri;
use App\Kriteria;
use App\Komoditi;
use App\Http\Controllers\Controller;

class WaspasController extends Controller
{
    
    public function index()
    {  
        $komoditi = Komoditi::all();         
        return view('2_pilih_komoditi',compact('komoditi','CR'));                             
    }

    // public function index2()
    // {
    //     $kriteria = Kriteria::all();            
               
    //     $autosubmit = 1;     
    //     $bypass=1;                                                  
    //     return view('1_bobot',compact('kriteria','autosubmit','bypass'));                             
    // }


    public function hitung(Request $request)
    {  
        $komoditi = $request->komoditi_id;

        $industri = Industri::all()->where('komoditi_id',$komoditi)
                                    ->where('tenaga_kerja', '!=', null)
                                    ->where('kapasitas_produksi', '!=', null)
                                    ->where('nilai_investasi', '!=', null);
        $industri = $industri->values();
        $jumlah   = Industri::all()->where('komoditi_id',$komoditi)
                                    ->where('tenaga_kerja', '!=', null)
                                    ->where('kapasitas_produksi', '!=', null)
                                    ->where('nilai_investasi', '!=', null)->count();
        $kriteria = Kriteria::all();

        $pilihan_komoditi = Komoditi::where("id_komoditi",$komoditi)->first();
        $nama_komoditi = $pilihan_komoditi->nama_komoditi; 
        
        if($komoditi == 0){
            
            return redirect()->back()->with('error', 'Belum memilih komoditi');
        }
        if($jumlah < 2){
            
            return redirect()->back()->with('info', 'IKM dengan komoditi '.$nama_komoditi.' kurang dari 2');
        }

        $alternatif = 1;
        for($x=0; $x<$jumlah; $x++){       
            $m_X[$x][0]=$industri[$x]->id_industri;
            $m_X[$x][1]=$industri[$x]->nama_industri;
            $m_X[$x][2]=$industri[$x]->tenaga_kerja;
            $m_X[$x][3]=$industri[$x]->kapasitas_produksi;
            $m_X[$x][4]=$industri[$x]->nilai_investasi;
            $m_X[$x][5]=$industri[$x]->nama_pemilik;
            $m_X[$x][6]=$alternatif;
            $alternatif++;  
        }

        $urutan = 0;
        for($x=0; $x<$jumlah; $x++){
            if($m_X[$x][2] <= $m_X[$urutan][2]){
                $urutan = $x;
                $C1_min = $m_X[$x][2];
            }
        }
        $urutan = 0;
        for($x=0; $x<$jumlah; $x++){
            if($m_X[$x][3] >= $m_X[$urutan][3]){
                $urutan = $x;
                $C2_max = $m_X[$x][3];
            }
        }
        $urutan = 0;
        for($x=0; $x<$jumlah; $x++){
            if($m_X[$x][4] <= $m_X[$urutan][4]){
                $urutan = $x;
                $C3_min = $m_X[$x][4];
            }
        }      

        for($x=0; $x<$jumlah; $x++){
            $m_normalisasi[$x][0]=$m_X[$x][0];
            $m_normalisasi[$x][1]=$m_X[$x][1];
            $m_normalisasi[$x][2]=$C1_min/$m_X[$x][2];
            $m_normalisasi[$x][3]=$m_X[$x][3]/$C2_max;
            $m_normalisasi[$x][4]=$C3_min/$m_X[$x][4];
        }

        for ($i=0; $i < $jumlah; $i++) { 
            $m_Qi_1[$i][5] = 0;
        }
        for($x=0; $x<$jumlah; $x++){
            $m_Qi_1[$x][0]=$m_normalisasi[$x][0];
            $m_Qi_1[$x][1]=$m_normalisasi[$x][1];
            $m_Qi_1[$x][2]=$m_normalisasi[$x][2] * $kriteria[0]->w;
            $m_Qi_1[$x][3]=$m_normalisasi[$x][3] * $kriteria[1]->w;
            $m_Qi_1[$x][4]=$m_normalisasi[$x][4] * $kriteria[2]->w;
            for($y=2; $y <= 4; $y++){
                $m_Qi_1[$x][5]+=$m_Qi_1[$x][$y];
            }
            $m_Qi_1[$x][6]=$m_Qi_1[$x][5] * 0.5;
        }

        for ($i=0; $i < $jumlah; $i++) { 
            $m_Qi_2[$i][5] = 1;
        }
        for($x=0; $x<$jumlah; $x++){
            $m_Qi_2[$x][0]=$m_normalisasi[$x][0];
            $m_Qi_2[$x][1]=$m_normalisasi[$x][1];
            $m_Qi_2[$x][2]=pow($m_normalisasi[$x][2], $kriteria[0]->w);
            $m_Qi_2[$x][3]=pow($m_normalisasi[$x][3], $kriteria[1]->w);
            $m_Qi_2[$x][4]=pow($m_normalisasi[$x][4], $kriteria[2]->w);
            for($y=2; $y <= 4; $y++){
                $m_Qi_2[$x][5]*=$m_Qi_2[$x][$y];
            }
            $m_Qi_2[$x][6]=$m_Qi_2[$x][5] * 0.5;
        }

        for ($x=0; $x<$jumlah ; $x++) { 
            $m_Qi[$x][0]=$m_normalisasi[$x][0];
            $m_Qi[$x][1]=$m_normalisasi[$x][1];
            $m_Qi[$x][2]=$m_Qi_1[$x][6]+$m_Qi_2[$x][6];
        }

        
        for ($x=0; $x < $jumlah ; $x++) { 
            $m_rank[$x][0]=$m_X[$x][6];
            $m_rank[$x][1]=$m_Qi[$x][1];
            $m_rank[$x][2]=$m_X[$x][5];
            $m_rank[$x][3]=$m_Qi[$x][2];
        }
        array_multisort(array_column($m_rank, 3),SORT_DESC,$m_rank);

        return view('2_perhitungan',compact('industri','jumlah','m_X','m_normalisasi','m_Qi_1','m_Qi_2','m_Qi','m_rank','nama_komoditi'));                             
    }
}