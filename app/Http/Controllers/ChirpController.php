<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->get();
        return view('chirps.index', ['chirps' => $chirps]);
    }

    public function create()
    {
        return view('chirps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        return view('chirps.edit', ['chirp' => $chirp]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}