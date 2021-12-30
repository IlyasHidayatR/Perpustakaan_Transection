<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rak extends Model
{
    use HasFactory;
    protected $table='rak';
    protected $primaryKey='id_rak';
    protected $fillable=['id_rak', 'nama_rak', 'lokasi_rak', 'id_buku', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Buku()
    {
        return $this->belongsTo('App\Models\Buku', 'id_buku');
    }

    static function getDetail(){
        $return = DB::table('rak')
        ->join('buku','rak.id_buku','=','buku.id_buku');
        return $return;
    }
}
