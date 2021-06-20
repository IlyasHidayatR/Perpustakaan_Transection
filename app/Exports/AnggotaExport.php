<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnggotaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Anggota::all();
    }

    public function headings(): array
    {
        return [
           'id_anggota',
           'kode_anggota', 
           'nama_anggota', 
           'jk_anggota', 
           'jurusan_anggota', 
           'no_telp_anggota', 
           'alamat_anggota'
        ];
    }
}
