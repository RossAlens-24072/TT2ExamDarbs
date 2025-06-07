<?php

namespace App\Http\Controllers;

use App\Models\Ieraksti;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|max:100',
        'content' => 'required',
        'tema_id' => 'required|exists:temas,id',
        ]);

        $validated['user_id'] = auth()->id();

        \App\Models\Ieraksti::create($validated);

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts pievienots!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ieraksts = \App\Models\Ieraksti::with(['user', 'tema', 'komentari'])->findOrFail($id);

        return view('ieraksti.show', compact('ieraksts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ieraksts = \App\Models\Ieraksti::findOrFail($id);

        if (auth()->id() !== $ieraksts->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Jums nav atļaujas dzēst šo ierakstu.');
        }

        $ieraksts->delete();

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts dzēsts!');
    }
}
