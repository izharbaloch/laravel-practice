<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="p-5 sm:p-6 space-y-6">

        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-indigo-600 to-purple-700 rounded-2xl p-6 shadow-xl shadow-indigo-200">
            <div class="relative z-10">
                <p class="text-indigo-200 text-sm font-medium mb-1">Welcome back,</p>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ Auth::user()->name }} 👋</h1>
                <p class="text-indigo-200 text-sm max-w-md">Manage your notes, stay organized and boost your productivity.</p>
                <div class="flex gap-3 mt-5">
                    <a href="{{ route('notes.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white text-indigo-700 text-sm font-semibold rounded-xl hover:bg-indigo-50 transition-colors shadow-sm">
                        <i class="fas fa-plus text-xs"></i> New Note
                    </a>
                    <a href="{{ route('notes.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium rounded-xl hover:bg-white/25 transition-colors border border-white/20">
                        <i class="fas fa-list text-xs"></i> View All
                    </a>
                </div>
            </div>
            <!-- Decorative circles -->
            <div class="absolute -right-8 -top-8 w-48 h-48 bg-white/5 rounded-full"></div>
            <div class="absolute -right-4 top-12 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="absolute right-16 -bottom-10 w-40 h-40 bg-purple-500/20 rounded-full"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $totalNotes  = Auth::user()->notes()->count();
                $activeNotes = Auth::user()->notes()->where('status', 1)->count();
                $inactiveNotes = Auth::user()->notes()->where('status', 0)->count();
                $trashedNotes = Auth::user()->notes()->onlyTrashed()->count();
            @endphp

            <!-- Total Notes -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <i class="fas fa-note-sticky text-blue-500 text-base"></i>
                    </div>
                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Total</span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $totalNotes }}</h3>
                    <p class="text-sm text-slate-500 mt-0.5 font-medium">All Notes</p>
                </div>
            </div>

            <!-- Active Notes -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                        <i class="fas fa-circle-check text-emerald-500 text-base"></i>
                    </div>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Active</span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $activeNotes }}</h3>
                    <p class="text-sm text-slate-500 mt-0.5 font-medium">Active Notes</p>
                </div>
            </div>

            <!-- Inactive Notes -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                        <i class="fas fa-circle-pause text-amber-500 text-base"></i>
                    </div>
                    <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Inactive</span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $inactiveNotes }}</h3>
                    <p class="text-sm text-slate-500 mt-0.5 font-medium">Inactive Notes</p>
                </div>
            </div>

            <!-- Trash -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div class="w-11 h-11 bg-rose-50 rounded-xl flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                        <i class="fas fa-trash-can text-rose-500 text-base"></i>
                    </div>
                    <span class="text-xs font-medium text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full">Trash</span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-slate-800">{{ $trashedNotes }}</h3>
                    <p class="text-sm text-slate-500 mt-0.5 font-medium">In Trash</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions + Recent Info -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- Quick Actions -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <h2 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-bolt text-amber-500 text-xs"></i> Quick Actions
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="{{ route('notes.index') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-100 hover:border-indigo-200 transition-all group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-md shadow-indigo-200 group-hover:scale-105 transition-transform">
                            <i class="fas fa-plus text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-indigo-700">Create Note</p>
                            <p class="text-xs text-indigo-400">Add a new note</p>
                        </div>
                    </a>

                    <a href="{{ route('notes.index') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-200 transition-all group">
                        <div class="w-10 h-10 bg-slate-600 rounded-xl flex items-center justify-center shadow-md shadow-slate-200 group-hover:scale-105 transition-transform">
                            <i class="fas fa-list-ul text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Browse Notes</p>
                            <p class="text-xs text-slate-400">View all your notes</p>
                        </div>
                    </a>

                    <a href="{{ route('trash.notes') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-100 hover:border-rose-200 transition-all group">
                        <div class="w-10 h-10 bg-rose-500 rounded-xl flex items-center justify-center shadow-md shadow-rose-200 group-hover:scale-105 transition-transform">
                            <i class="fas fa-trash-can text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-rose-700">View Trash</p>
                            <p class="text-xs text-rose-400">{{ $trashedNotes }} note(s) deleted</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 p-4 rounded-xl bg-purple-50 hover:bg-purple-100 border border-purple-100 hover:border-purple-200 transition-all group">
                        <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center shadow-md shadow-purple-200 group-hover:scale-105 transition-transform">
                            <i class="fas fa-gear text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-purple-700">Profile</p>
                            <p class="text-xs text-purple-400">Manage settings</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Overview Card -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <h2 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-indigo-500 text-xs"></i> Overview
                </h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-slate-600 font-medium">Active Notes</span>
                            <span class="text-emerald-600 font-semibold">{{ $totalNotes > 0 ? round(($activeNotes/$totalNotes)*100) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-700"
                                 style="width: {{ $totalNotes > 0 ? round(($activeNotes/$totalNotes)*100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-slate-600 font-medium">Inactive Notes</span>
                            <span class="text-amber-600 font-semibold">{{ $totalNotes > 0 ? round(($inactiveNotes/$totalNotes)*100) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-amber-500 h-2 rounded-full transition-all duration-700"
                                 style="width: {{ $totalNotes > 0 ? round(($inactiveNotes/$totalNotes)*100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-slate-600 font-medium">Trashed</span>
                            <span class="text-rose-600 font-semibold">{{ ($totalNotes + $trashedNotes) > 0 ? round(($trashedNotes/($totalNotes+$trashedNotes))*100) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-rose-500 h-2 rounded-full transition-all duration-700"
                                 style="width: {{ ($totalNotes + $trashedNotes) > 0 ? round(($trashedNotes/($totalNotes+$trashedNotes))*100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <p class="text-xs text-slate-500 text-center">
                        Logged in as <span class="font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                    </p>
                    <p class="text-xs text-slate-400 text-center mt-0.5">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
