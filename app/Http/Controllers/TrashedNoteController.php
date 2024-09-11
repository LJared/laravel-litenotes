<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index()
    {
        // Fetch all notes of the current user
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $notes = Note::whereBelongsTo($user)->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

    public function update(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $note->restore();
        return to_route('notes.show', ['note' => $note])
            ->with('success', 'Note restored successfully');
    }

    public function destroy(Note $note)
    {
        // Verify if the authenticated user owns the note
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $note->forceDelete();
        return to_route('trashed.index')->with('success', 'Note permanently deleted');
    }
}
