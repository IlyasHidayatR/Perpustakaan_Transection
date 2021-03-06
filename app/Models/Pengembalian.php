<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table='pengembalian';
    protected $primaryKey='id_pengembalian';
    protected $fillable=['id_pengembalian', 'denda', 'id_buku', 'id_anggota', 'id_petugas', 'created_at', 'updated_at'];
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

    public function Peminjaman()
    {
        return $this->belongsTo('App\Models\Peminjaman', 'id_peminjaman');
    }

    public function Transaksi()
    {
        return $this->hasMany('App\Models\Transaksi');
    }

    static function getDetail(){
        $return = DB::table('pengembalian')
        ->join('anggota','pengembalian.id_anggota','=','anggota.id_anggota')
        ->join('petugas','pengembalian.id_petugas','=','petugas.id_petugas')
        ->join('buku','pengembalian.id_buku','=','buku.id_buku');
        return $return;
    }
}
