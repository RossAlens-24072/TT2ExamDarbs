<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentari;
use App\Models\Balsojumi;
use Illuminate\Support\Facades\Auth;

class BalsojumiController extends Controller
{
    public function vote(Request $request, Komentari $komentars)
    {
        $request->validate([
            'vote_type' => 'required|in:up,down',
        ]);

        Balsojumi::updateOrCreate(
        [
            'user_id'=> Auth::id(),
            'komentari_id' => $komentars->id,
        ],

        [
            'vote_type' => $request->vote_type,
        ]
    
    );
    return back()->with('success', 'Balsojums saglabāts!');
    }
}