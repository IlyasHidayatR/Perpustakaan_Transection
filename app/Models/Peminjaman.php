<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table='peminjaman';
    protected $primaryKey='id_peminjaman';
    protected $fillable=['id_peminjaman', 'tanggal_pinjam', 'tanggal_kembali', 'id_buku', 'id_anggota', 'id_petugas', 'created_at', 'updated_at'];
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
