<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl mb-5 shadow-sm">
            <div class="w-6 h-6 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                <i class="fas fa-check text-emerald-600 text-xs"></i>
            </div>
            <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors ml-1">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>
    @endif

    <!-- Create / Edit Form -->
    @if ($showForm)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-5"
             x-data x-init="$el.scrollIntoView({ behavior: 'smooth', block: 'start' })">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm
                            {{ $editId ? 'bg-amber-50' : 'bg-indigo-50' }}">
                    <i class="fas fa-{{ $editId ? 'pen' : 'plus' }} text-sm
                               {{ $editId ? 'text-amber-600' : 'text-indigo-600' }}"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">{{ $editId ? 'Edit Note' : 'Create New Note' }}</h2>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $editId ? 'Update your note details' : 'Fill in the details to add a new note' }}</p>
                </div>
            </div>

            <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Title -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">
                            Note Title <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               wire:model.defer="title"
                               placeholder="What's the note about?"
                               class="w-full px-4 py-3 rounded-xl border bg-slate-50 text-slate-800 text-sm placeholder-slate-400 transition-all
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white
                                      @error('title') border-rose-300 bg-rose-50 @else border-slate-200 @enderror">
                        @error('title')
                            <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1.5">
                                <i class="fas fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">
                            Description <span class="text-rose-500">*</span>
                        </label>
                        <textarea wire:model.defer="description"
                                  rows="4"
                                  placeholder="Write your note content here..."
                                  class="w-full px-4 py-3 rounded-xl border bg-slate-50 text-slate-800 text-sm placeholder-slate-400 resize-none transition-all
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white
                                         @error('description') border-rose-300 bg-rose-50 @else border-slate-200 @enderror"></textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs text-rose-500 flex items-center gap-1.5">
                                <i class="fas fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <select wire:model.defer="category_id"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm transition-all
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white">
                            <option value="">Select a category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm
                                       {{ $editId ? 'bg-amber-500 hover:bg-amber-600 text-white shadow-amber-200' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-200' }}">
                            <i class="fas fa-{{ $editId ? 'floppy-disk' : 'plus' }} text-xs"></i>
                            {{ $editId ? 'Update Note' : 'Save Note' }}
                        </button>
                        <button type="button"
                                wire:click="cancel"
                                class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-colors">
                            <i class="fas fa-xmark text-xs"></i> Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif

    <!-- Notes Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100">

        <!-- Card Header -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-note-sticky text-indigo-600 text-sm"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">All Notes</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Your personal notes</p>
                </div>
            </div>
            @if (!$showForm)
                <button type="button"
                        wire:click="openForm"
                        class="flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                    <i class="fas fa-plus text-xs"></i>
                    <span class="hidden sm:inline">Add Note</span>
                </button>
            @endif
        </div>

        <!-- Filters Bar -->
        <div class="px-5 sm:px-6 py-3.5 border-b border-slate-100 bg-slate-50/60">
            <div class="flex flex-col sm:flex-row gap-2.5">
                <!-- Search -->
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400 text-xs"></i>
                    </div>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Search notes..."
                           class="w-full pl-9 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 transition-all
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <!-- Status Filter -->
                <select wire:model.live="status"
                        class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-700 text-sm transition-all
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">All Statuses</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

                <!-- Category Filter -->
                <select wire:model.live="category"
                        class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-700 text-sm transition-all
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Title</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider hidden md:table-cell">Description</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider hidden lg:table-cell">Category</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider hidden xl:table-cell">Remind At</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="text-center px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Toggle</th>
                        <th class="text-right px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notes as $note)
                        <tr class="border-b border-slate-50 hover:bg-slate-50/70 transition-colors group">
                            <td class="px-5 sm:px-6 py-4 text-slate-400 font-medium text-xs">{{ $loop->iteration }}</td>

                            <td class="px-5 sm:px-6 py-4">
                                <span class="font-semibold text-slate-800">{{ $note->title }}</span>
                            </td>

                            <td class="px-5 sm:px-6 py-4 hidden md:table-cell max-w-xs">
                                <span class="text-slate-500 text-xs line-clamp-2">{{ Str::limit($note->description, 60) }}</span>
                            </td>

                            <td class="px-5 sm:px-6 py-4 hidden lg:table-cell">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    {{ $note->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <td class="px-5 sm:px-6 py-4 hidden xl:table-cell">
                                <span class="text-xs text-slate-500">
                                    {{ $note->remind_at ? \Carbon\Carbon::parse($note->remind_at)->format('M d, Y') : '—' }}
                                </span>
                            </td>

                            <td class="px-5 sm:px-6 py-4">
                                @if($note->status)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span> Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 sm:px-6 py-4 text-center">
                                <button wire:click="toggleStatus({{ $note->id }})"
                                        class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full cursor-pointer transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1
                                               {{ $note->status ? 'bg-indigo-600' : 'bg-slate-200' }}">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-200
                                                 {{ $note->status ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </td>

                            <td class="px-5 sm:px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button"
                                            wire:click="edit({{ $note->id }})"
                                            title="Edit"
                                            class="p-2 text-amber-600 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-pen text-xs"></i>
                                    </button>
                                    <button type="button"
                                            wire:click="delete({{ $note->id }})"
                                            onclick="return confirm('Move this note to trash?') || event.stopImmediatePropagation()"
                                            title="Trash"
                                            class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                    <a href="{{ route('trash.notes') }}"
                                       title="View Trash"
                                       class="p-2 text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">
                                        <i class="fas fa-box-archive text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-note-sticky text-3xl text-slate-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-slate-600 font-semibold">No notes found</p>
                                        <p class="text-slate-400 text-sm mt-1">
                                            @if($search || $status !== '' || $category !== '')
                                                Try adjusting your filters
                                            @else
                                                Create your first note to get started
                                            @endif
                                        </p>
                                    </div>
                                    @if(!$showForm)
                                        <button wire:click="openForm"
                                                class="mt-1 flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                                            <i class="fas fa-plus text-xs"></i> Create Note
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($notes->hasPages())
            <div class="px-5 sm:px-6 py-4 border-t border-slate-100">
                {{ $notes->links() }}
            </div>
        @endif
    </div>
</div>
