<?php

namespace App\Exports;

use App\Industri;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class IndustriExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {   
        $industri=industri::all();

        return $industri;
    }

    public function map($industri): array
    {
        return[
            $industri->nama_industri,
            $industri->nama_pemilik,
            $industri->alamat,
            $industri->telp,
            $industri->tenaga_kerja,
            $industri->nilai_investasi,
            $industri->kapasitas_produksi,
            $industri->komoditi->nama_komoditi
        ];
    }

    public function headings(): array
    {
        return[
            'Nama Industri',
            'Nama Pemilik',
            'Alamat',
            'No Telp',
            'Tenaga Kerja',
            'Nilai Investasi',
            'Kapasitas Produksi',
            'Komoditi'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:I1')
                                ->getFont()
                                ->setBold(true);
   
            },
        ];
    }










    // public function collection()
    // {
    //     $industri = Industri::select("*",
    //                 \DB::raw('(CASE 
    //                     WHEN komoditi_id = "1" THEN "Sandang"
    //                     WHEN komoditi_id = "2" THEN "Pangan"
    //                     WHEN komoditi_id = "3" THEN "Kimia dan Bahan Bangunan"
    //                     WHEN komoditi_id = "4" THEN "Kerajinan"
    //                     WHEN komoditi_id = "5" THEN "Jasa Reparasi"
    //                     WHEN komoditi_id = "6" THEN "Elektronika/Logam"
    //                     WHEN komoditi_id = "7" THEN "Alat Transportasi"
    //                     WHEN komoditi_id = "0" THEN "Belum pilih komoditi"
    //                     END) AS komoditi_id'))
    //              ->get();

    //     return $industri;
    // }
}
