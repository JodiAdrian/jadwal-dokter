<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJadwalDokterRequest;
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

        $jadwal_dokters = JadwalDokter::with('dokter')->get();

        // mapping data
        $mappedData = $jadwal_dokters->map(function ($item) {
            return [
                'id' => $item->id,
                'dokter_id' => $item->dokter_id,
                'day' => $item->day,
                'time_start' => $item->time_start,
                'time_finish' => $item->time_finish,
                'quota' => $item->quota,
                'status' => $item->status,
                'doctor_name' => $item->dokter->nama_dokter ?? null,
                'date' => $item->date,
            ];
        });


        return response()->json([
            'message' => 'berhasil',
            'body' => $mappedData,
        ]);
    }

    // Simpan jadwal dokter baru
    public function store(StoreJadwalDokterRequest $request)
    {
        $validated = $request->validated();

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $targetDay = strtolower($validated['day']);

        $dates = CarbonPeriod::create($startDate, $endDate);
        $jadwalList = [];
 
        foreach ($dates as $date) {
            // "Thrusday" !== "wednesday"
            // "2025-05-02" !== "wednesday"
            // "2025-05-03" !== "wednesday"
            // "2025-05-04" !== "wednesday"
            // "wednesday" !== "wednesday"
            if (strtolower($date->translatedFormat('l')) !== $targetDay) {
                continue; // Skip if the date does not match the target day
            }

            $jadwal = [
                'dokter_id'   => $validated['dokter_id'],
                'day'         => $validated['day'],
                'time_start'  => $validated['time_start'],
                'time_finish' => $validated['time_finish'],
                'quota'       => $validated['quota'],
                'status'      => $validated['status'],
                'date'        => $date->format('Y-m-d'),
            ];

            JadwalDokter::create($jadwal);
            $jadwalList[] = $jadwal;
        }

        return response()->json([
            'message' => 'Jadwal dokter berhasil disimpan',
            'body'    => $jadwalList,
        ]);
    }
}
