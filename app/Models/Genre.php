<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table='genre_anime';
    protected $primaryKey='id_genre';
    protected $fillable = ['id_genre', 'nama_genre', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function Anime()
    {
        return $this->hasMany('App\Models\Anime');
    }
}
