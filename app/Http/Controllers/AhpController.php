<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kriteria;
use App\Bobot_perbandingan;
use App\Http\Controllers\Controller;

class AhpController extends Controller
{
    
    public function index()
    {
        $kriteria = Kriteria::all();            
        
        $autosubmit = 0; 
        $bypass=0;                                                 
        return view('1_bobot',compact('kriteria','autosubmit','bypass'));                             
    }

    public function index2()
    {
        $kriteria = Kriteria::all();            
               
        $autosubmit = 1;    
        $bypass=0;                                                   
        return view('1_bobot',compact('kriteria','autosubmit','bypass'));                             
    }

    // Printf Database perbandingan
    public static function getNilaiBP($x,$y)
    {
        $id_k1 = $x+1;                                                    
        $id_k2 = $y+1;                                                    

        $data_bp = Bobot_perbandingan::where('kriteria1', $id_k1)
                                     ->where('kriteria2', $id_k2)           
                                     ->first();
                                    
        $nilai_bp = $data_bp->nilai;                                      

        return $nilai_bp;
    }

    // Input Database perbandingan
    public static function inputNilaiBP_Baru($x,$y,$nilai) 
    {
        $id_k1 = $x+1;
        $id_k2 = $y+1;

        DB::table('bobot_perbandingan')->where('kriteria1',$id_k1)          
                                       ->where('kriteria2', $id_k2)
                                       ->update([    
            'nilai' => $nilai
        ]);
    }

    // Input Database Bobot
    public static function inputKriteria($id_kriteria,$w) 
    {
        Kriteria::where('id_kriteria',$id_kriteria)                       
                ->update([    
            'w' => $w
        ]);

    }

    // Rumus Eigen Vector
    public static function getEigenVector($matrik_a,$w) 
    {
        $eigenvektor = 0;
        for ($i=0; $i <= 2 ; $i++) {
            $eigenvektor += ($matrik_a[$i] * $w[$i]);                      
        }

        return $eigenvektor;
    }

    // Rumus CI
    public static function getConsIndex($matrik_a,$w) 
    {
        $eigenvektor = static::getEigenVector($matrik_a,$w);
        $consindex = ($eigenvektor - 3)/2;                                 

        return $consindex;
    }

    // Rumus CR
    public static function getConsRatio($matrik_a,$w) 
    {
        $consindex = static::getConsIndex($matrik_a,$w);                   
        $consratio = $consindex / 0.58;                                    
                                                                            
        return $consratio;
    }

    // Proses Utama AHP
    public function matriks_p(Request $request)
    {
        $kriteria = Kriteria::all(); 

        $urut = 0;

        for ($x=0; $x <= 1 ; $x++) {                                        
            for ($y=($x+1); $y <= 2 ; $y++) {
                $urut++;
                $pilih  = "pilih".$urut;                                    
                $bobot  = "bobot".$urut;
                if ($request[$pilih] == 1) {                               
                    $matrik[$x][$y] = $request[$bobot];                     
                    $matrik[$y][$x] = 1 / $request[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $request[$bobot];
                    $matrik[$y][$x] = $request[$bobot];
                }

                static::inputNilaiBP_Baru($x,$y,$matrik[$x][$y]);           
            }
        }

        for ($i = 0; $i <= 2; $i++) {
            $matrik[$i][$i] = 1;                                            
        }

        for ($i=0; $i <= 2; $i++) {
            $jml_m1[$i] = 0;                                               
            $jml_m2[$i] = 0;                                               
        }

        for ($x=0; $x <= 2 ; $x++) {
            for ($y=0; $y <= 2 ; $y++) {                                   
                $jml_m1[$y] += $matrik[$x][$y];                            
            }                                                               
        }

        for ($x=0; $x <= 2 ; $x++) {                                        
            for ($y=0; $y <= 2 ; $y++) {                                    
                $matrik_2[$x][$y] = $matrik[$x][$y] / $jml_m1[$y];          
                $jml_m2[$x] += $matrik_2[$x][$y];                           
            }                                                               

            $w[$x]  = $jml_m2[$x] / 3;                                     

            $id_k = $x+1;                                                  
            static::inputKriteria($id_k,$w[$x]);
        }

        $ev   = static::getEigenVector($jml_m1,$w);                        
        $CI   = static::getConsIndex($jml_m1,$w);                         
        $CR   = static::getConsRatio($jml_m1,$w);                          

        $bypass=$request->bypass;
        
        return view('1_matriks_perbandingan',compact('kriteria','jml_m1','jml_m2','matrik','matrik_2','w','ev','CI','CR','bypass'));
    }
}