<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Notes List</h4>

            @if (!$showForm)
                <button type="button" class="btn btn-primary" wire:click="openForm">
                    <i class="fas fa-plus mr-1"></i> Add Notes
                </button>
            @endif

        </div>

        <div class="card-body">
            @if ($showForm)
                <div class="border rounded p-3 mb-4">
                    <h5 class="mb-3">
                        Create Note
                    </h5>
                    <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Note title</label>
                                <input type="text" wire:model.defer="title"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>Note Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer='description'></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 d-flex align-items-end mt-3">
                                @if ($editId)
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-save mr-1"></i> Update
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-save mr-1"></i> Save
                                    </button>
                                @endif

                                <button type="button" class="btn btn-secondary" wire:click="cancel">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" wire:model.live.debounce.300ms="search"
                        placeholder="Search exam...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>

                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notes as $note)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->description }}</td>
                                <td>{{ $note->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"
                                        wire:click="edit({{ $note->id }})">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $note->id }})"
                                        onclick="confirm('Delete this exam?') || event.stopImmediatePropagation()">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $notes->links() }}
            </div>
        </div>
    </div>
</div>
