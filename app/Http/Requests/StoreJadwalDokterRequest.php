<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalDokterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dokter_id' => 'required|exists:dokter,id',
            'day' => 'required|string',
            'time_start' => 'required|string',
            'time_finish' => 'required|string',
            'quota' => 'required|integer',
            'status' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'dokter_id.required' => 'ID dokter wajib diisi.',
            'dokter_id.exists' => 'ID dokter tidak ditemukan.',
            'day.required' => 'Hari wajib diisi.',
            'day.string' => 'Hari harus berupa string.',
            'time_start.required' => 'Waktu mulai wajib diisi.',
            'time_start.string' => 'Waktu mulai harus berupa string.',
            'time_finish.required' => 'Waktu selesai wajib diisi.',
            'time_finish.string' => 'Waktu selesai harus berupa string.',
            'quota.required' => 'Kuota wajib diisi.',
            'quota.integer' => 'Kuota harus berupa angka.',
            'status.required' => 'Status wajib diisi.',
            'status.boolean' => 'Status harus berupa boolean.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
        ];
    }
}
