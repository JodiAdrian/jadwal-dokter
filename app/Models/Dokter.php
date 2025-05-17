<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'nama_dokter',
    ];

    public function jadwal()
    {
        return $this->hasMany(JadwalDokter::class, 'dokter_id');
    }
}
