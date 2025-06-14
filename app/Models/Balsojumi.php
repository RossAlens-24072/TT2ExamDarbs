<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balsojumi extends Model
{
    protected $table = 'balsojumi';

    protected $fillable = ['vote_type', 'user_id', 'komentari_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Komentars()
    {
        return $this->belongsTo(Komentari::class, 'komentari_id');
    }
}
