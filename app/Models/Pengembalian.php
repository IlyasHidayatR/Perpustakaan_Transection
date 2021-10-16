<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table='pengembalian';
    protected $primaryKey='id_pengembalian';
    protected $fillable=['id_pengembalian', 'tanggal_pengembalian', 'denda', 'id_buku', 'id_anggota', 'id_petugas', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }

    public function Buku()
    {
        return $this->belongsTo('App\Models\Buku', 'id_buku');
    }
    
    public function Petugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'id_petugas');
    }
}
