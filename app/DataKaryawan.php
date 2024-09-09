<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    protected $guarded = [];

    public function bagian() {
        return $this->belongTo(DataBagian::class, 'bagian', 'bagian');
    }
}
