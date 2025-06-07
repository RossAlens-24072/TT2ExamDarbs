<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    public function ieraksti()
    {
        return $this->hasMany(Ieraksti::class);
    }
}
