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
            <h4>Trash Notes List</h4>

        </div>

        <div class="card-body">
            {{-- <div class="row mb-3">
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
            </div> --}}

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th width="70">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trashNotes as $note)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->description }}</td>
                                <td>{{ $note->created_at }}</td>
                                <td>{{ $note->status ? 'Active' : 'InActive' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"
                                        wire:click="restore({{ $note->id }})"
                                        onclick="confirm('Restore this notes?') || event.stopImmediatePropagation()">
                                        Restore
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $note->id }})"
                                        onclick="confirm('Delete this notes permanently?') || event.stopImmediatePropagation()">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No notes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $trashNotes->links() }}
            </div>
        </div>
    </div>
</div>
