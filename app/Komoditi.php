<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komoditi extends Model
{
    public $timestamps = false;

    protected $table = "komoditi";

    protected $primaryKey = 'id_komoditi';

    protected $fillable = [
        'nama_komoditi',
    ];

    public function industri(){
        return $this->hasMany(Industri::class);
    }
}
 