<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ieraksti extends Model
{
    protected $table = 'ieraksti';

    protected $fillable = ['title', 'content', 'tema_id', 'user_id', 'bilde'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function komentari()
    {
        return $this->hasMany(Komentari::class);
    }

    public function balsojumi()
    {
        return $this->hasMany(Balsojumi::class);
    }

    public function bildes()
    {
        return $this->hasMany(Bildes::class);
    }
}
