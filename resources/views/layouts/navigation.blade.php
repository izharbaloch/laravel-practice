<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-30 w-64 flex flex-col bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 shadow-2xl
               transition-transform duration-300 ease-in-out
               md:relative md:translate-x-0 md:z-auto"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <!-- Logo / Brand -->
    <div class="h-16 flex items-center px-5 border-b border-white/10 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <i class="fas fa-book-open text-white text-sm"></i>
            </div>
            <div>
                <span class="text-white font-bold text-base tracking-tight">NoteApp</span>
                <p class="text-slate-500 text-xs leading-tight">Your workspace</p>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 py-5 px-3 space-y-0.5 overflow-y-auto">
        <p class="px-3 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-widest">Main</p>

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                  {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                        {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fas fa-house text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
            </div>
            Dashboard
            @if(request()->routeIs('dashboard'))
                <span class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></span>
            @endif
        </a>

        <p class="px-3 pt-4 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-widest">Notes</p>

        <a href="{{ route('notes.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                  {{ request()->routeIs('notes.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                        {{ request()->routeIs('notes.index') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fas fa-note-sticky text-sm {{ request()->routeIs('notes.index') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
            </div>
            My Notes
            @if(request()->routeIs('notes.index'))
                <span class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></span>
            @endif
        </a>

        <a href="{{ route('trash.notes') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                  {{ request()->routeIs('trash.notes') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                        {{ request()->routeIs('trash.notes') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fas fa-trash-can text-sm {{ request()->routeIs('trash.notes') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
            </div>
            Trash
            @if(request()->routeIs('trash.notes'))
                <span class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></span>
            @endif
        </a>

        <p class="px-3 pt-4 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-widest">Account</p>

        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                  {{ request()->routeIs('profile.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-400 hover:bg-white/8 hover:text-white' }}">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                        {{ request()->routeIs('profile.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                <i class="fas fa-gear text-sm {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"></i>
            </div>
            Settings
            @if(request()->routeIs('profile.*'))
                <span class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></span>
            @endif
        </a>
    </nav>

    <!-- User Profile Strip -->
    <div class="p-3 border-t border-white/10 shrink-0">
        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white/5 border border-white/10">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-500/30 shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Sign Out"
                        class="p-1.5 rounded-lg text-slate-500 hover:bg-white/10 hover:text-slate-300 transition-colors">
                    <i class="fas fa-right-from-bracket text-xs"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
