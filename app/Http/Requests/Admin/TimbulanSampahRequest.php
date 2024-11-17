<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TimbulanSampahRequest extends FormRequest
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
            'kategori' => 'required|string|max:255',      // Contoh: Desa, Perumahan, Wilayah Lain
            'nama' => 'required|string|max:255',          // Nama desa atau perumahan
            'jumlah' => 'required|numeric|min:0',         // Timbulan sampah dalam ton
        ];
    }
}
