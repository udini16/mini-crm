<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MiniCRM') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
        
        <style>
            .bg-samurai {
                background-image: url('{{ asset('images/samurai_bg_wide.jpg') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .blockquote {
                padding-left: 2rem;
                position: relative;
                overflow: hidden;
            }
            .blockquote::before,
            .blockquote::after {
                position: absolute;
                color: #777;
            }   
            .blockquote p {
                margin: 0;
                font-family: 'Playfair Display', serif;
                font-weight: 700;
            }
            .blockquote p + p {
                margin-top: 1rem;
            }
            .button-54 {
                font-family: 'Playfair Display', serif;
                font-size: 16px;
                letter-spacing: 2px;
                text-decoration: none;
                text-transform: uppercase;
                color: #000;
                background-color: #fff;
                cursor: pointer;
                border: 3px solid #000;
                padding: 0.25em 0.5em;
                box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
                position: relative;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                transition: all 0.1s;
            }
            .button-54:active {
                box-shadow: 0px 0px 0px 0px;
                top: 5px;
                left: 5px;
            }
            @media (min-width: 768px) {
                .button-54 {
                    padding: 0.25em 0.75em;
                }
            }
            .blockquote--slashes::before {
                content: "//";
                transform: rotate(90deg);
                left: 0;
            }   
            .blockquote--slashes::after {
                content: "";
                left: 5px;
                top: 25px;
                width: 1px;
                height: 100%;
                background-color: currentColor;
            }    
            .blockquote--classic::before {
                content:  url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='%23777777'><path d='M9.983 3v7.391C9.983 16.095 6.252 19.961 1 21l-.995-2.151C2.437 17.932 4 15.211 4 13H0V3h9.983zM24 3v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151C16.437 17.932 18 15.211 18 13h-3.983V3H24z'/></svg>");
                left: 0;
            }   
            .blockquote--classic::after {
                content: "";
                left: 5px;
                top: 25px;
                width: 1px;
                height: 100%;
                background-color: currentColor;
            }  
        </style>
    </head>
    <body class="font-['Playfair_Display'] antialiased bg-slate-900 text-slate-100 selection:bg-indigo-500 selection:text-white">
        
        <!-- Hero Section -->
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-slate-900">
            <!-- Grayscale Background Image -->
            <div class="absolute inset-0 bg-samurai grayscale z-0"></div>
            <!-- Overlay to make text readable over the background -->
            <div class="absolute inset-0 bg-black/50 z-0"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent z-0"></div>

            <!-- Top Navigation / Branding -->
            <div class="absolute top-6 left-6 z-20 flex items-center">
                <img src="{{ asset('images/minicrm_logo.png') }}" alt="MiniCRM" class="h-28 md:h-32 w-auto object-contain invert opacity-90" />
            </div>
            <!-- Main Content Area -->
            <div class="relative z-10 w-full px-6 lg:px-16 xl:px-32 flex flex-col items-end justify-center text-left mt-10">
                <div class="max-w-2xl w-full ml-auto">
                    <blockquote class="blockquote blockquote--classic mb-12">
                        <p class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white drop-shadow-2xl leading-tight">
                            A streamlined, elegant solution for managing your companies and employees.
                        </p>
                    </blockquote>

                    <div class="flex flex-col sm:flex-row gap-4 justify-start items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="button-54">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="button-54">Admin Login</a>
                        @endauth
                    @endif
                </div>
            </div>
            </div>
            
            <!-- Scroll Indicator -->
            <a href="#features" class="absolute bottom-10 z-20 flex flex-col items-center text-white/70 hover:text-white transition-colors animate-bounce">
                <span class="text-sm font-medium tracking-widest uppercase mb-2">Scroll Down</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </a>
        </div>

        <!-- Features Section -->
        <div id="features" class="min-h-screen bg-slate-900 py-24 flex flex-col justify-center">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                
                <div class="text-center mb-20">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Everything you need to manage your business</h2>
                    <p class="mt-4 text-lg text-slate-400">Simple, powerful tools designed for maximum productivity.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                    <!-- Company Management -->
                    <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-slate-700/50 transform hover:-translate-y-2 transition-all duration-300 hover:border-indigo-500/50 hover:shadow-indigo-900/20 group">
                        <div class="w-14 h-14 bg-indigo-500/10 rounded-xl flex items-center justify-center mb-6 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Company Management</h3>
                        <p class="text-base text-slate-400 leading-relaxed">Easily keep track of all your corporate clients and partners in one place. Add logos, websites, and contact emails effortlessly.</p>
                    </div>
                    
                    <!-- Employee Directory -->
                    <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-slate-700/50 transform hover:-translate-y-2 transition-all duration-300 hover:border-purple-500/50 hover:shadow-purple-900/20 group">
                        <div class="w-14 h-14 bg-purple-500/10 rounded-xl flex items-center justify-center mb-6 text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Employee Directory</h3>
                        <p class="text-base text-slate-400 leading-relaxed">Manage staff members and link them seamlessly to their respective companies. Keep track of phone numbers and contact emails.</p>
                    </div>
                    
                    <!-- RESTful API -->
                    <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-slate-700/50 transform hover:-translate-y-2 transition-all duration-300 hover:border-emerald-500/50 hover:shadow-emerald-900/20 group">
                        <div class="w-14 h-14 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-6 text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">RESTful API</h3>
                        <p class="text-base text-slate-400 leading-relaxed">Integrate with other services effortlessly using our built-in JSON API. Pull company details and employee counts programmatically.</p>
                    </div>
                </div>

                <div class="mt-32 border-t border-slate-800 pt-8 flex justify-between items-center text-sm text-slate-500">
                    <p>&copy; {{ date('Y') }} Mini-CRM. All rights reserved.</p>
                    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
                </div>
            </div>
        </div>

    </body>
</html>
