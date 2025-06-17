<?php

namespace App\Http\Controllers;

use App\Models\Ieraksti;
use Illuminate\Routing\Controller;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentari;

class IerakstiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ieraksti = Ieraksti::with(['user', 'tema'])->latest()->get();
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
            'bilde'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        ],[
            'title.required' => 'Lūdzu, ievadi ieraksta nosaukumu.',
            'title.max' => 'Nosaukums nedrīkst pārsniegt 100 simbolus.',
            'content.required' => 'Lūdzu, aizpildi aprakstu.',
            'tema_id.required' => 'Lūdzu, izvēlies tēmu.',
            'tema_id.exists' => 'Izvēlētā tēma neeksistē.',
        ]);

        $imagePath = null;

        if ($request->hasFile('bilde')) {
            $imagePath = $request->file('bilde')->store('ieraksti_bildes', 'public');
        }

        Ieraksti::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'tema_id'=> $request->tema_id,
            'user_id' => Auth::id(),
            'bilde' => $imagePath,
        ]);
        log_audit('ieraksts_pievienots', null, ['title' => $request->title]);

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts pievienots!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ieraksts = Ieraksti::with(['user', 'tema'])->findOrFail($id);

        $komentari = Komentari::with('user')
            ->where('ieraksti_id', $ieraksts->id)
            ->withCount([
                'balsojumi as upvotes_count' => function ($query) {
                    $query->where('vote_type', 'up');
                },
                'balsojumi as downvotes_count' => function ($query) {
                    $query->where('vote_type', 'down');
                },
            ])
            ->get()
            ->sortByDesc(function ($komentars) {
                return ($komentars->upvotes_count ?? 0) - ($komentars->downvotes_count ?? 0);
            });

        return view('ieraksti.show', compact('ieraksts', 'komentari'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ieraksts = Ieraksti::findOrFail($id);
        $temas = Tema::all();

        if (Auth::id() !== $ieraksts->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Jums nav atļaujas rediģēt šo ierakstu.');
        }

        return view('ieraksti.edit',compact('ieraksts', 'temas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'nullable|max:100',
        'content' => 'nullable',
        'tema_id' => 'nullable|exists:temas,id',
        'bilde'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
    ]);

    $ieraksts = Ieraksti::findOrFail($id);

    if (Auth::id() !== $ieraksts->user_id && Auth::user()->role !== 'admin') {
        abort(403, 'Jums nav atļaujas rediģēt šo ierakstu.');
    }

    $data = [];

    if ($request->filled('title')) {
        $data['title'] = $request->title;
    }

    if ($request->filled('content')) {
        $data['content'] = $request->content;
    }

    if ($request->filled('tema_id')) {
        $data['tema_id'] = $request->tema_id;
    }

    if ($request->hasFile('bilde')) {
        $data['bilde'] = $request->file('bilde')->store('ieraksti_bildes', 'public');
    }

    $ieraksts->update($data);

    log_audit('ieraksts_rediģēts', null, ['title' => $request->title]);

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

        log_audit('ieraksts_dzēsts', $ieraksti, ['title' => $request->title]);

        return redirect()->route('ieraksti.index')->with('success', 'Ieraksts dzēsts!');
    }

    public function __construct()
    {
        // Tikai autorizēti lietotāji var veidot, rediģēt un dzēst ierakstus
        $this->middleware('auth')->except(['index', 'show']);
    }
}
