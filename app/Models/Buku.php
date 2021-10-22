<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table='buku';
    protected $primaryKey='id_buku';
    protected $fillable=['id_buku', 'kode_buku', 'judul_buku', 'penulis_buku', 'penerbit_buku', 'tahun_penerbit', 'stok', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }

    public function Pengembalian()
    {
        return $this->hasMany('App\Models\Pengembalian');
    }

    public function Rak()
    {
        return $this->hasMany('App\Models\Rak');
    }

    public function Transaksi()
    {
        return $this->hasMany('App\Models\Transaksi');
    }
}
