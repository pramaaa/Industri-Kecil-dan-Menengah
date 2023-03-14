<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    public $timestamps = false;

    protected $table = "industri";

    protected $primaryKey = 'id_industri';

    protected $fillable = [
        'nama_industri',
        'nama_pemilik',
        'alamat',
        'telp',
        'tenaga_kerja',
        'nilai_investasi',
        'kapasitas_produksi',
        'komoditi_id',
    ];

    public function komoditi(){
        return $this->belongsTo(Komoditi::class,'komoditi_id');
    }
}
 