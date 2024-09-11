<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all notes of the current user
        $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = Notebook::where('user_id', Auth::id())->get();
        return view('notes.create')->with('notebooks', $notebooks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:200',
            'text' => 'required',
            'notebook_id' => 'exists:notebooks,id',
        ]);

        // Create the new not through the model
        $note = Auth::user()->notes()->create([
            'notebook_id' => $request->get('notebook_id'),
            'uuid' => Str::uuid(),
            'title' => $request->get('title'),
            'text' => $request->get('text'),
        ]);
        return to_route('notes.show', ['note' => $note]);;
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $notebooks = Notebook::where('user_id', Auth::id())->get();
        return view('notes.edit', ['note' => $note, 'notebooks' => $notebooks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }

        // Validate the request
        $request->validate([
            'title' => 'required|max:200',
            'text' => 'required',
            'notebook_id' => 'exists:notebooks,id',
        ]);

        // Create the new not through the model
        $note->update([
            'title' => $request->get('title'),
            'text' => $request->get('text'),
            'notebook_id' => $request->get('notebook_id'),
        ]);
        return to_route('notes.show', ['note' => $note])
            ->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }

        $note->delete();
        return to_route('notes.index')->with('success', 'Note deleted successfully');
    }
}
