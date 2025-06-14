<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Komentari extends Model
{
    protected $table = 'komentari';
    protected $fillable = ['ieraksti_id', 'content', 'user_id', 'parent_komentari_id', 'image_path',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ieraksti()
    {
        return $this->belongsTo(Ieraksti::class);
    }

    public function parent()
    {
        return $this->belongsTo(Komentari::class, 'parent_komentari_id');
    }

    public function replies()
    {
        return $this->hasMany(Komentari::class, 'parent_komentari_id');
    }

    public function bildes()
    {
        return $this->hasMany(Bildes::class);
    }

    public function balsojumi()
    {
        return $this->hasMany(Balsojumi::class, 'komentari_id');
    }

    public function balsuSumma()
    {
        return $this->balsojumi()->selectRaw("SUM(CASE WHEN vote_type = 'up' THEN 1 WHEN vote_type = 'down' THEN -1 ELSE 0 END) as total")->value('total') ?? 0;
    }

    public function lietotajaBalss()
    {
        return $this->balsojumi()->where('user_id', Auth::id())->first();
    }
}
