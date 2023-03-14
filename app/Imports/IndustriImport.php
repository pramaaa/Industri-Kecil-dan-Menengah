<?php

namespace App\Imports;

use App\Industri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndustriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if((stripos($row['tenaga_kerja'],'-'))!==false){
            $row['tenaga_kerja']=null;
        }

        if((stripos($row['nilai_investasi'],'-'))!==false){
            $row['nilai_investasi']=null;
        }

        if((stripos($row['kapasitas_produksi'],'-'))!==false){
            $row['kapasitas_produksi']=null;
        }

        if((stripos($row['komoditi'],'alat transportasi'))!==false){
            $row['komoditi']="1";
        }
        else if ((stripos($row['komoditi'],'bahan bangunan'))!==false) {
            $row['komoditi']="2";
        }
        else if ((stripos($row['komoditi'],'bengkel'))!==false) {
            $row['komoditi']="3";
        }
        else if ((stripos($row['komoditi'],'elektronika/logam'))!==false) {
            $row['komoditi']="4";
        }
        else if ((stripos($row['komoditi'],'jasa reparasi'))!==false) {
            $row['komoditi']="5";
        }
        else if ((stripos($row['komoditi'],'kerajinan'))!==false) {
            $row['komoditi']="6";
        }
        else if ((stripos($row['komoditi'],'laundry'))!==false) {
            $row['komoditi']="7";
        }
        else if ((stripos($row['komoditi'],'pangan'))!==false) {
            $row['komoditi']="8";
        }
        else if ((stripos($row['komoditi'],'percetakan'))!==false) {
            $row['komoditi']="9";
        }
        else if ((stripos($row['komoditi'],'sandang'))!==false) {
            $row['komoditi']="10";
        }
        else if ((stripos($row['komoditi'],'variasi/showroom'))!==false) {
            $row['komoditi']="11";
        }
        else if ((stripos($row['komoditi'],'vulkanis ban'))!==false) {
            $row['komoditi']="12";
        }
        else
            $row['komoditi']="0";
        
        return new Industri([
            'nama_industri' => $row['nama_industri'],
            'nama_pemilik' => $row['nama_pemilik'], 
            'alamat' => $row['alamat'], 
            'telp' => $row['no_telp'], 
            'tenaga_kerja' => $row['tenaga_kerja'], 
            'nilai_investasi' => $row['nilai_investasi'],
            'kapasitas_produksi' => $row['kapasitas_produksi'],
            'komoditi_id' => $row['komoditi'],
        ]);
    }
}
