<?php

namespace App\Livewire\Notes;

use App\Events\NoteStatusChanged;
use App\Jobs\SendNoteReminder;
use App\Models\Category;
use App\Models\Note as ModelsNote;
use Livewire\Component;
use Livewire\WithPagination;

class Note extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title = '';
    public $description = '';
    public $category_id = '';
    public $showForm = false;
    public $editId = null;
    public $categories = [];

    public $search = '';

    public $status = '';

    public $category = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function openForm()
    {
        $this->showForm = true;
    }

    public function mount()
    {
        $this->categories = Category::get();
    }

    public function save()
    {
        $validate = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        // dd($validate);

        $note = ModelsNote::create([
            'title' => $validate['title'],
            'user_id' => auth()->user()->id,
            'category_id' => $validate['category_id'],
            'description' => $validate['description'],
            'remind_at' => now()->addMinutes(5), // Set remind_at to 5 minutes from now for testing
        ]);

        SendNoteReminder::dispatch($note)->delay($note->remind_at); // Dispatch the job with a delay of 5 minutes

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
        $this->category_id = $note->category_id;

        $this->showForm = true;
        $this->resetValidation();
    }

    public function update()
    {
        $validate = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $note = ModelsNote::find($this->editId);

        $note->update([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'category_id' => $validate['category_id'],
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
        $oldStatus = $note->status;

        $note->status = !$note->status; // auto toggle
        $note->save();

        event(new NoteStatusChanged(
            $note,
            $oldStatus,
            $note->status,
        ));

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

    public function updatingCategory()
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
            'category_id'
        ]);

        $this->title = '';
        $this->description = '';
        $this->category_id = '';

        $this->resetValidation();
    }

    public function render()
    {
        $notes = ModelsNote::query()->where('user_id', auth()->user()->id)

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
            ->when($this->category !== '', function ($query) {
                $query->where('category_id', $this->category);
            })
            ->with(['category'])

            ->latest()
            ->paginate(5);

        return view('livewire.notes.note', compact('notes'));
    }
}
