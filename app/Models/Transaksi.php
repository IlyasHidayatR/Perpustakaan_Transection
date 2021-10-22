<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksi';
    protected $primaryKey='id_transaksi';
    protected $fillable=['id_transaksi', 'id_peminjaman', 'id_pengembalian', 'id_anggota', 'id_buku', 'denda', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }

    public function Buku()
    {
        return $this->belongsTo('App\Models\Buku', 'id_buku');
    }

    public function Peminjaman()
    {
        return $this->belongsTo('App\Models\Peminjaman', 'id_peminjaman');
    }

    public function Pengembalian()
    {
        return $this->belongsTo('App\Models\Pengembalian', 'id_pengembalian');
    }
}
