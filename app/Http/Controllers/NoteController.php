<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
        $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
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
        ]);

        // Create the new not through the model
        $note = Note::create([
            'user_id' => Auth::id(),
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
        if ($note->user_id !== Auth::id()) {
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
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }
        return view('notes.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // Verify if the authenticated user owns the note
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        // Validate the request
        $request->validate([
            'title' => 'required|max:200',
            'text' => 'required',
        ]);

        // Create the new not through the model
        $note->update([
            'title' => $request->get('title'),
            'text' => $request->get('text'),
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
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();
        return to_route('notes.index')->with('success', 'Note deleted successfully');
    }
}
