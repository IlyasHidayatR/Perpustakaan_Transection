<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    use HasFactory;
    protected $table='anggota';
    protected $primaryKey='id_anggota';
    protected $fillable=['id_anggota', 'kode_anggota', 'nama_anggota', 'jk_anggota', 'jurusan_anggota', 'no_telp_anggota', 'alamat_anggota', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }

    public function Pengembalian()
    {
        return $this->hasMany('App\Models\Pengembalian');
    }

    public function Transaksi()
    {
        return $this->hasMany('App\Models\Transaksi');
    }
}
