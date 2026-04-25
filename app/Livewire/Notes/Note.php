<?php

namespace App\Livewire\Notes;

use App\Models\Note as ModelsNote;
use Livewire\Component;
use Livewire\WithPagination;

class Note extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title = '';
    public $description = '';
    public $showForm = false;
    public $editId = null;

    public $search = '';

    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function openForm()
    {
        $this->showForm = true;
    }

    public function save()
    {
        $validate = $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        ModelsNote::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
        ]);

        session()->flash('success', 'Note added successfully');

        $this->resetForm();
        $this->showForm = false;
        $this->resetPage();
    }

    public function edit($id)
    {
        $note = ModelsNote::find($id);
        $this->editId = $note->id;
        $this->title = $note->title;
        $this->description = $note->description;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function update()
    {
        $validate = $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $note = ModelsNote::find($this->editId);

        $note->update([
            'title' => $validate['title'],
            'description' => $validate['description'],
        ]);

        session()->flash('success', 'Note update successfully');

        $this->resetForm();
        $this->showForm = false;
        $this->resetPage();
    }

    public function delete($id)
    {
        $note = ModelsNote::find($id);
        // dd($note);
        $note->delete();
        session()->flash('success', 'Note delete successfully');
    }

    public function toggleStatus($id)
    {
        $note = ModelsNote::find($id);

        $note->status = !$note->status; // auto toggle
        $note->save();

        session()->flash('success', 'Note Status Updated');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function cancel()
    {
        $this->showForm = false;
        $this->resetValidation();
        $this->resetForm();
        $this->editId = null;
    }

    public function resetForm()
    {
        $this->reset([
            'title',
            'description',
        ]);

        $this->title = '';
        $this->description = '';

        $this->resetValidation();
    }

    public function render()
    {
        $notes = ModelsNote::query()

            // Search filter
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })

            // Status filter (separate)
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })

            ->latest()
            ->paginate(5);

        return view('livewire.notes.note', compact('notes'));
    }
}
