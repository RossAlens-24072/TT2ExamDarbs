<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Ieraksti;

class TemasController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tema = Tema::findOrFail($id);
        $ieraksti = Ieraksti::where('tema_id', $id)->latest()->paginate(6);

        return view('temas.show', compact('tema', 'ieraksti'));
    }
}
