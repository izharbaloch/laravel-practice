<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NoteApp') }} — Your Smart Notes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50" style="font-family:'Inter',sans-serif;">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md shadow-indigo-200">
                    <i class="fas fa-book-open text-white text-xs"></i>
                </div>
                <span class="font-bold text-slate-800 text-base">NoteApp</span>
            </a>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                        <i class="fas fa-home text-xs"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-slate-700 hover:text-indigo-600 text-sm font-medium transition-colors">
                        Sign In
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Badge -->
                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-semibold rounded-full mb-6">
                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
                    Simple. Fast. Organized.
                </span>

                <!-- Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight mb-5">
                    Your ideas, <br>
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        perfectly organized
                    </span>
                </h1>

                <p class="text-lg text-slate-500 mb-9 max-w-xl mx-auto leading-relaxed">
                    Capture, organize, and manage your notes effortlessly.
                    NoteApp keeps everything in one place so you can focus on what matters.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="w-full sm:w-auto flex items-center justify-center gap-2 px-7 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl transition-all shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5">
                            <i class="fas fa-home text-xs"></i> Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="w-full sm:w-auto flex items-center justify-center gap-2 px-7 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl transition-all shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5">
                            <i class="fas fa-rocket text-xs"></i> Start for Free
                        </a>
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto flex items-center justify-center gap-2 px-7 py-3.5 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-2xl border border-slate-200 transition-all hover:shadow-md hover:-translate-y-0.5">
                            <i class="fas fa-sign-in-alt text-xs text-slate-400"></i> Sign In
                        </a>
                    @endauth
                </div>
            </div>

            <!-- App Screenshot Preview -->
            <div class="mt-16 relative max-w-4xl mx-auto">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-50 z-10 rounded-2xl pointer-events-none" style="top:70%"></div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl shadow-slate-300/50 overflow-hidden">
                    <!-- Fake browser bar -->
                    <div class="bg-slate-100 border-b border-slate-200 px-4 py-3 flex items-center gap-2">
                        <span class="w-3 h-3 bg-rose-400 rounded-full"></span>
                        <span class="w-3 h-3 bg-amber-400 rounded-full"></span>
                        <span class="w-3 h-3 bg-emerald-400 rounded-full"></span>
                        <div class="flex-1 mx-4 bg-white rounded-lg px-3 py-1.5 text-xs text-slate-400 border border-slate-200">
                            noteapp.test/dashboard
                        </div>
                    </div>
                    <!-- Dashboard preview -->
                    <div class="flex bg-slate-50" style="height: 380px;">
                        <!-- Mini sidebar -->
                        <div class="w-48 bg-slate-900 p-3 flex flex-col gap-1 shrink-0">
                            <div class="flex items-center gap-2 px-2 py-2 mb-3">
                                <div class="w-6 h-6 bg-indigo-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-book-open text-white text-xs" style="font-size:8px"></i>
                                </div>
                                <span class="text-white text-xs font-bold">NoteApp</span>
                            </div>
                            <div class="flex items-center gap-2 px-2 py-2 rounded-lg bg-indigo-600">
                                <i class="fas fa-house text-white text-xs w-4 text-center" style="font-size:10px"></i>
                                <span class="text-white text-xs">Dashboard</span>
                            </div>
                            <div class="flex items-center gap-2 px-2 py-2 rounded-lg text-slate-400">
                                <i class="fas fa-note-sticky text-xs w-4 text-center" style="font-size:10px"></i>
                                <span class="text-xs">My Notes</span>
                            </div>
                            <div class="flex items-center gap-2 px-2 py-2 rounded-lg text-slate-400">
                                <i class="fas fa-trash-can text-xs w-4 text-center" style="font-size:10px"></i>
                                <span class="text-xs">Trash</span>
                            </div>
                        </div>
                        <!-- Mini content -->
                        <div class="flex-1 p-4 overflow-hidden">
                            <!-- Banner -->
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl p-4 text-white mb-4">
                                <p class="text-xs text-indigo-200">Welcome back,</p>
                                <p class="text-sm font-bold">John Doe 👋</p>
                            </div>
                            <!-- Stats mini -->
                            <div class="grid grid-cols-4 gap-2 mb-4">
                                <div class="bg-white rounded-xl p-2.5 border border-slate-100">
                                    <div class="text-xs font-bold text-slate-700">12</div>
                                    <div class="text-xs text-slate-400" style="font-size:9px">All Notes</div>
                                </div>
                                <div class="bg-white rounded-xl p-2.5 border border-slate-100">
                                    <div class="text-xs font-bold text-emerald-600">8</div>
                                    <div class="text-xs text-slate-400" style="font-size:9px">Active</div>
                                </div>
                                <div class="bg-white rounded-xl p-2.5 border border-slate-100">
                                    <div class="text-xs font-bold text-amber-600">4</div>
                                    <div class="text-xs text-slate-400" style="font-size:9px">Inactive</div>
                                </div>
                                <div class="bg-white rounded-xl p-2.5 border border-slate-100">
                                    <div class="text-xs font-bold text-rose-600">2</div>
                                    <div class="text-xs text-slate-400" style="font-size:9px">Trash</div>
                                </div>
                            </div>
                            <!-- Notes preview -->
                            <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">
                                <div class="px-3 py-2 border-b border-slate-100 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-slate-700">My Notes</span>
                                    <span class="text-xs bg-indigo-600 text-white px-2 py-0.5 rounded-lg">+ Add</span>
                                </div>
                                <div class="divide-y divide-slate-50">
                                    <div class="px-3 py-2 flex items-center justify-between">
                                        <span class="text-xs text-slate-700 font-medium">Meeting notes</span>
                                        <span class="text-xs bg-emerald-50 text-emerald-700 px-1.5 py-0.5 rounded-md">Active</span>
                                    </div>
                                    <div class="px-3 py-2 flex items-center justify-between">
                                        <span class="text-xs text-slate-700 font-medium">Project ideas</span>
                                        <span class="text-xs bg-emerald-50 text-emerald-700 px-1.5 py-0.5 rounded-md">Active</span>
                                    </div>
                                    <div class="px-3 py-2 flex items-center justify-between">
                                        <span class="text-xs text-slate-400 font-medium">Old draft</span>
                                        <span class="text-xs bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded-md">Inactive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 px-4 sm:px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-3">Everything you need</h2>
                <p class="text-slate-500 text-lg">Simple tools to keep your notes organized</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-note-sticky text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Create & Organize</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Create notes with titles, descriptions, and categories. Keep everything neatly organized in one place.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-magnifying-glass text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Instant Search</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Find any note instantly with live search and advanced filtering by category and status.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-toggle-on text-emerald-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Status Toggle</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Toggle notes between active and inactive states in one click. Always know the state of your notes.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-trash-can text-rose-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Safe Delete</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Notes go to trash first — restore them anytime or permanently delete when you're sure.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-bell text-amber-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Reminders</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Set reminders on your notes and get notified at the right time, so nothing slips through.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-lg hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <div class="w-12 h-12 bg-sky-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-shield-halved text-sky-600 text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Secure & Private</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Your notes belong only to you. Full authentication protects your account and all your data.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 bg-gradient-to-br from-indigo-600 to-purple-700">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to get organized?</h2>
            <p class="text-indigo-200 text-lg mb-8">Join NoteApp today and start capturing your ideas the smarter way.</p>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white text-indigo-700 text-sm font-bold rounded-2xl hover:bg-indigo-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5">
                    <i class="fas fa-home text-xs"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white text-indigo-700 text-sm font-bold rounded-2xl hover:bg-indigo-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-0.5">
                    <i class="fas fa-rocket text-xs"></i> Create Free Account
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 px-4 sm:px-6 py-8">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-book-open text-white" style="font-size:10px"></i>
                </div>
                <span class="text-white font-bold text-sm">NoteApp</span>
            </div>
            <p class="text-slate-500 text-xs">Built with Laravel & Livewire. Your notes, always safe.</p>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-slate-500 hover:text-slate-300 text-xs transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="text-slate-500 hover:text-slate-300 text-xs transition-colors">Register</a>
                @endguest
            </div>
        </div>
    </footer>

</body>
</html>
