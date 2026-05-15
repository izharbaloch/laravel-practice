<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class TrashNotes extends Component
{
    use WithPagination;

    public function restore($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->restore();
        session()->flash('success', 'Note restore successfully');
        $this->resetPage();
    }
    public function delete($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->forceDelete();
        session()->flash('success', 'Note delete successfully');
        $this->resetPage();
    }

    public function render()
    {
        $trashNotes = Note::onlyTrashed()->paginate(10);
        return view('livewire.notes.trash-notes', compact(['trashNotes']));
    }
}
