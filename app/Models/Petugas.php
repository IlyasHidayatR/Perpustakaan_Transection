<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Petugas extends Model
{
    use HasFactory;
    protected $table='petugas';
    protected $primaryKey='id_petugas';
    protected $fillable=['id_petugas', 'nama_petugas', 'jabatan_petugas', 'no_telp_petugas', 'alamat_petugas', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }

    public function Pengembalian()
    {
        return $this->hasMany('App\Models\Pengembalian');
    }
}
