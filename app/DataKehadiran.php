<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKehadiran extends Model
{
    protected $guarded = [];

    public function karyawan() {
        return $this->belongsTo(DataKaryawan::class, 'karyawan_id');
    }
}
