<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $table='rak';
    protected $primaryKey='id_rak';
    protected $fillable=['id_rak', 'nama_rak', 'lokasi_rak', 'id_buku'];
    public $timestamps = false;

    public function Buku()
    {
        return $this->belongsTo('App\Models\Buku', 'id_buku');
    }
}
