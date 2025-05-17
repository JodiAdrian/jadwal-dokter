<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'dokter_id',
        'day',
        'time_start',
        'time_finish',
        'quota',
        'status',
        'start_date',
        'end_date',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }   
}
