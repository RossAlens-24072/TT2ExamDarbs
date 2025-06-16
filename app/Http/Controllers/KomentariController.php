<?php

namespace App\Http\Controllers;

use App\Models\Komentari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;



class KomentariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->validate([
            'ieraksti_id' => 'required|exists:ieraksti,id',
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('komentari_bildes', 'public');
        }

        $komentars = Komentari::create([
            'ieraksti_id' => $request->ieraksti_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'image_path' => $imagePath,
        ]);

        log_audit('Komentārs_pievienots', $komentars, ['ieraksti_id' => $komentars->ieraksti_id]);

        return redirect()->back()->with('success', 'Komentārs pievienots!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
