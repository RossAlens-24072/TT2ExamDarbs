<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentari extends Model
{
    protected $table = 'komentari';
    protected $fillable = ['ieraksti_id', 'content', 'user_id', 'parent_komentari_id'];

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
}
