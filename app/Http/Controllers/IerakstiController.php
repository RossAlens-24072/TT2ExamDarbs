<?php

namespace App\Http\Controllers;

use App\Models\Ieraksti;
use App\Models\Tema;
use Illuminate\Http\Request;

class IerakstiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ieraksti = \App\Models\Ieraksti::with(['user', 'tema'])
        ->latest()
        ->paginate(6); // lapošana

        return view('ieraksti.index', compact('ieraksti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Ieraksti $ieraksti)
    {
        $temas = Tema::all();
        return view('ieraksti.create', compact('temas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'tema_id' => 'required|exists:temas,id',
        ]);

        Ieraksti::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'tema_id'=> $request->tema_id,
            'user_id' => 1,
        ]);

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts pievienots!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $ieraksts = \App\Models\Ieraksti::with(['user', 'tema', 'komentari'])->findOrFail($id);

        // return view('ieraksti.show', compact('ieraksts'));

        $ieraksts = Ieraksti::with(['user', 'tema', 'komentari'])->findOrFail($id);
        return view('ieraksti.show', compact('ieraksts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ieraksts = Ieraksti::findOrFail($id);
        $temas = Tema::all();

        return view('ieraksti.edit',compact('ieraksts', 'temas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'tema_id' => 'required|exists:temas,id',
        ]);

        $ieraksts = Ieraksti::findOrFail($id);

        $ieraksts->update($request->all());

        return redirect()->route('ieraksti.show', $ieraksts->id)->with('success', 'Ieraksts atjaunots veiksmīgi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ieraksti $ieraksti)
    {

        if ($request->user()->cannot('delete', $ieraksti)) {
            abort(403, 'Jums nav atļaujas dzēst šo ierakstu.');
        }

        $ieraksti->delete();

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts dzēsts!');
    }
}
