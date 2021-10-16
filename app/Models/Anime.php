<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;
    protected $table='judul_anime';
    protected $primaryKey='id_anime';
    protected $fillable = ['id_anime', 'nama_anime', 'id_genre', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Genre()
    {
        return $this->belongsTo('App\Models\Genre', 'id_genre');
    }
}
