<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $guarded = [];

    public function bagian() {
        return $this->belongTo(Bagian::class, 'bagian', 'bagian');
    }
}
