<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balsojumi extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ieraksti()
    {
        return $this->belongsTo(Ieraksti::class);
    }
}
