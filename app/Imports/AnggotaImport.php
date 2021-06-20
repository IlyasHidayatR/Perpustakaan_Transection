<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AnggotaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function rules(): array
    {
        return[
            'kode_anggota' => 'required',
            'nama_anggota' => 'required',
            'jk_anggota' => 'required',
            'jurusan_anggota' => 'required',
            'no_telp_anggota' => 'required',
            'alamat_anggota' => 'required',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggota([
            //
            'kode_anggota' => $row['kode_anggota'],
            'nama_anggota' => $row['nama_anggota'],
            'jk_anggota' => $row['jk_anggota'],
            'jurusan_anggota' => $row['jurusan_anggota'],
            'no_telp_anggota' => $row['no_telp_anggota'],
            'alamat_anggota' => $row['alamat_anggota'],
        ]);
    }
}
