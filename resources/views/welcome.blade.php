<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Mini-CRM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="font-['Inter'] antialiased bg-slate-50 text-slate-900 selection:bg-indigo-500 selection:text-white">
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
            <!-- Background gradients -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-100 via-slate-50 to-slate-50"></div>
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            </div>

            <div class="relative z-10 w-full max-w-5xl px-6 lg:px-8 flex flex-col items-center text-center">
                
                <div class="mb-8 flex items-center justify-center space-x-3">
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 transform hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-800 tracking-tight">Mini<span class="text-indigo-600">CRM</span></span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6 drop-shadow-sm">
                    Manage your business <br class="hidden md:block" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">beautifully.</span>
                </h1>
                
                <p class="mt-4 text-lg md:text-xl text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                    A streamlined, elegant solution for managing your companies and employees. Designed for speed, built for productivity.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group relative px-8 py-4 bg-slate-900 text-white font-semibold rounded-full overflow-hidden shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:shadow-slate-900/30 transition-all duration-300 transform hover:-translate-y-1">
                                <span class="relative z-10 flex items-center gap-2">
                                    Go to Dashboard
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="group relative px-8 py-4 bg-indigo-600 text-white font-semibold rounded-full overflow-hidden shadow-xl shadow-indigo-600/20 hover:shadow-2xl hover:shadow-indigo-600/40 transition-all duration-300 transform hover:-translate-y-1">
                                <span class="relative z-10 flex items-center gap-2">
                                    Admin Login
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        @endauth
                    @endif
                </div>

                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl w-full">
                    <div class="bg-white/60 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-slate-100 transform hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Company Management</h3>
                        <p class="text-sm text-slate-500">Easily keep track of all your corporate clients and partners in one place.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-slate-100 transform hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-4 text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Employee Directory</h3>
                        <p class="text-sm text-slate-500">Manage staff members and link them seamlessly to their respective companies.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-slate-100 transform hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">RESTful API</h3>
                        <p class="text-sm text-slate-500">Integrate with other services effortlessly using our built-in JSON API.</p>
                    </div>
                </div>
            </div>
            
            <footer class="absolute bottom-6 text-sm text-slate-400 font-medium">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>

        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
        </style>
    </body>
</html>
