<div>
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
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

    <!-- Trash Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-rose-50 rounded-xl flex items-center justify-center">
                    <i class="fas fa-trash-can text-rose-500 text-sm"></i>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">Trash</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Deleted notes — restore or permanently remove</p>
                </div>
            </div>
            <a href="{{ route('notes.index') }}"
               class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-colors">
                <i class="fas fa-arrow-left text-xs"></i>
                <span class="hidden sm:inline">Back to Notes</span>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Title</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider hidden md:table-cell">Description</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider hidden lg:table-cell">Deleted At</th>
                        <th class="text-left px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 sm:px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trashNotes as $note)
                        <tr class="border-b border-slate-50 hover:bg-rose-50/30 transition-colors">
                            <td class="px-5 sm:px-6 py-4 text-slate-400 font-medium text-xs">{{ $loop->iteration }}</td>

                            <td class="px-5 sm:px-6 py-4">
                                <span class="font-semibold text-slate-500 line-through decoration-slate-300">{{ $note->title }}</span>
                            </td>

                            <td class="px-5 sm:px-6 py-4 hidden md:table-cell max-w-xs">
                                <span class="text-slate-400 text-xs">{{ Str::limit($note->description, 60) }}</span>
                            </td>

                            <td class="px-5 sm:px-6 py-4 hidden lg:table-cell">
                                <span class="text-xs text-slate-500">
                                    @if($note->deleted_at)
                                        <span class="inline-flex items-center gap-1.5 text-rose-500">
                                            <i class="fas fa-clock text-xs"></i>
                                            {{ \Carbon\Carbon::parse($note->deleted_at)->format('M d, Y') }}
                                        </span>
                                    @else
                                        {{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y') }}
                                    @endif
                                </span>
                            </td>

                            <td class="px-5 sm:px-6 py-4">
                                @if($note->status)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span> Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 sm:px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            wire:click="restore({{ $note->id }})"
                                            onclick="return confirm('Restore this note?') || event.stopImmediatePropagation()"
                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-xl transition-colors border border-emerald-100">
                                        <i class="fas fa-rotate-left"></i>
                                        <span class="hidden sm:inline">Restore</span>
                                    </button>
                                    <button type="button"
                                            wire:click="delete({{ $note->id }})"
                                            onclick="return confirm('Permanently delete this note? This cannot be undone.') || event.stopImmediatePropagation()"
                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold rounded-xl transition-colors border border-rose-100">
                                        <i class="fas fa-trash"></i>
                                        <span class="hidden sm:inline">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-trash-can text-3xl text-slate-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-slate-600 font-semibold">Trash is empty</p>
                                        <p class="text-slate-400 text-sm mt-1">Deleted notes will appear here</p>
                                    </div>
                                    <a href="{{ route('notes.index') }}"
                                       class="mt-1 flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                                        <i class="fas fa-arrow-left text-xs"></i> Back to Notes
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($trashNotes->hasPages())
            <div class="px-5 sm:px-6 py-4 border-t border-slate-100">
                {{ $trashNotes->links() }}
            </div>
        @endif
    </div>
</div>
