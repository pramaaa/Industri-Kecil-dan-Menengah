<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bobot_perbandingan extends Model
{
    public $timestamps = false;

    protected $table = "bobot_perbandingan";

    protected $primaryKey = 'id_bp';

    protected $fillable = [
        'kriteria1',
        'kriteria2',
        'nilai',
    ];
}
 