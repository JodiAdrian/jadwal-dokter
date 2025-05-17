<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    // Menampilkan semua jadwal dokter
    // named index because it is a common convention for the index method in a controller
    // to return a list of resources.
    public function index()
    {
        $jadwals = JadwalDokter::with('dokter')->get(); // semua jadwal
        $results = []; // inisiasi array untuk menyimpan hasil

        foreach ($jadwals as $jadwal) {
            $start = Carbon::parse($jadwal->start_date);
            $end = Carbon::parse($jadwal->end_date);

            $targetDay = strtolower($jadwal->day); // contoh: "monday"
            $period = CarbonPeriod::create($start, $end);

            foreach ($period as $date) {
                // Cek apakah hari dari $date sesuai dengan 'day' pada jadwal
                if (strtolower($date->translatedFormat('l')) == $targetDay) {
                    $results[] = [
                        'id' => $jadwal->id,
                        'dokter_id' => $jadwal->dokter_id,
                        'day' => $jadwal->day,
                        'time_start' => $jadwal->time_start,
                        'time_finish' => $jadwal->time_finish,
                        'quota' => $jadwal->quota,
                        'status' => $jadwal->status,
                        'doctor_name' => $jadwal->dokter->nama_dokter ?? null,
                        'date' => $date->toDateString(),
                    ];
                }
            }
        }

        return response()->json([
            'message' => 'berhasil',
            'body' => $results
        ]);
    }


    // Simpan jadwal dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'day' => 'required|string',
            'time_start' => 'required|string',
            'time_finish' => 'required|string',
            'quota' => 'required|integer',
            'status' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $jadwal = JadwalDokter::create($request->all());

        return response()->json($jadwal, 201);
    }
}
