<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bildes extends Model
{
    public function ieraksti()
    {
        return $this->belongsTo(Ieraksti::class);
    }

    public function komentari()
    {
        return $this->belongsTo(Komentari::class);
    }
}
