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
                            <div class="form-group col-md-12 mt-3">
                                <select class="form-select" aria-label="Default select example"
                                    wire:model.defer='category_id'>
                                    <option selected>Please Select Note Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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

                <div class="col-md-4">
                    <select class="form-control" wire:model.live="status">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" wire:model.live="category">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Remind At</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notes as $note)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->description }}</td>
                                <td>{{ $note->category->name }}</td>
                                <td>{{ $note->remind_at ? $note->remind_at : 'N/A' }}</td>
                                <td>{{ $note->status ? 'Active' : 'InActive' }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" wire:click="toggleStatus({{ $note->id }})"
                                            {{ $note->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"
                                        wire:click="edit({{ $note->id }})">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $note->id }})"
                                        onclick="confirm('Delete this exam?') || event.stopImmediatePropagation()">
                                        Trash
                                    </button>
                                    <a href="{{ route('trash.notes') }}" class="btn btn-sm btn-info">View Trash</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No notes found.</td>
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
