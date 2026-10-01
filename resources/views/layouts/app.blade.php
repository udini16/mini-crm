<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiniCRM') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        
        <!-- Intl-Tel-Input for Phone numbers -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>

        <!-- Swup for smooth transitions -->
        <script src="https://unpkg.com/swup@4"></script>

        <style>
            /* Swup Transition Styles */
            .transition-fade {
                transition: opacity 0.3s ease, transform 0.3s ease;
                opacity: 1;
                transform: translateY(0);
            }
            html.is-animating .transition-fade {
                opacity: 0;
                transform: translateY(10px);
            }

            .anim-btn-container {
                position: relative;
                height: 48px;
                width: 200px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .anim-button {
                background: #2B2D2F;
                height: 48px;
                width: 200px;
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                cursor: pointer;
                border-radius: 8px;
                z-index: 10;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .anim-text {
                font: bold 1rem/1 'Playfair Display', serif;
                color: #71DFBE;
                pointer-events: none;
                white-space: nowrap;
            }

            .anim-progress-bar {
                position: absolute;
                height: 6px;
                width: 0;
                top: 50%;
                left: 50%;
                border-radius: 200px;
                transform: translate(-50%, -50%);
                background: #71DFBE;
                z-index: 11;
            }

            .anim-svg {
                width: 24px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 12;
            }

            .anim-check, .anim-cross {
                fill: none;
                stroke: #1D1F20;
                stroke-width: 4;
                stroke-linecap: round;
                stroke-linejoin: round;
            }
            .anim-error-svg {
                opacity: 0;
                width: 24px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 12;
            }

            /* Custom intl-tel-input dark theme overrides */
            .iti { width: 100%; }
            .iti__country-list { 
                background-color: #1E293B !important; 
                border: 1px solid #334155 !important; 
                color: #F1F5F9 !important; 
            }
            
            /* Custom scrollbar for the dropdown */
            .iti__country-list::-webkit-scrollbar {
                width: 8px;
            }
            .iti__country-list::-webkit-scrollbar-track {
                background: #1E293B; 
            }
            .iti__country-list::-webkit-scrollbar-thumb {
                background: #475569; 
                border-radius: 4px;
            }
            .iti__country-list::-webkit-scrollbar-thumb:hover {
                background: #64748B; 
            }

            .iti__country.iti__highlight {
                background-color: #334155 !important; 
            }
            .iti__divider {
                border-bottom: 1px solid #334155 !important;
            }
            .iti__dial-code {
                color: #94A3B8 !important; 
            }
            .iti__search-input {
                background-color: #0F172A !important; 
                border: 1px solid #334155 !important;
                color: #F1F5F9 !important;
                margin-bottom: 5px !important;
            }
            .iti__selected-country {
                background-color: transparent !important;
            }

        <style>
            .bg-samurai {
                background-image: url('{{ asset('images/samurai_bg_wide.jpg') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .button-54 {
                font-family: 'Playfair Display', serif;
                font-size: 16px;
                letter-spacing: 2px;
                text-decoration: none;
                text-transform: uppercase;
                color: #fff;
                cursor: pointer;
                border: 3px solid #fff;
                padding: 0.25em 0.5em;
                box-shadow: 1px 1px 0px 0px #fff,
                    2px 2px 0px 0px #fff,
                    3px 3px 0px 0px #fff,
                    4px 4px 0px 0px #fff,
                    5px 5px 0px 0px #fff;
                position: relative;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                background-color: transparent;
                transition: transform 0.1s ease, box-shadow 0.1s ease;
            }

            .button-54:active {
                box-shadow: 0px 0px 0px 0px #fff;
                transform: translateY(5px) translateX(5px);
            }

            @media (min-width: 768px) {
                .button-54 {
                    padding: 0.25em 0.75em;
                }
            }
        </style>
    </head>
    <body class="font-['Playfair_Display'] antialiased text-slate-900 bg-slate-100 overflow-hidden">
        
        <div class="flex h-screen w-full relative">
            <!-- Grayscale Background Image -->
            <div class="absolute inset-0 bg-samurai grayscale opacity-10 z-0"></div>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-slate-100/50 z-0"></div>

            <!-- Sidebar Navigation -->
            <div class="relative z-10 w-64 flex-shrink-0 bg-white/90 backdrop-blur-xl border-r border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="h-20 flex items-center justify-center border-b border-slate-200 px-6">
                        <a href="{{ url('/') }}" class="flex items-center gap-3">
                            <img src="{{ asset('images/favicon.png') }}" alt="MiniCRM" class="h-8 w-auto opacity-90" />
                            <span class="text-xl font-bold tracking-wider text-slate-900">MiniCRM</span>
                        </a>
                    </div>

                    <nav id="swup-sidebar" class="mt-6 px-4 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-black text-white shadow-lg' : 'text-slate-600 hover:bg-slate-100 hover:text-black' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('companies.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('companies.*') ? 'bg-black text-white shadow-lg' : 'text-slate-600 hover:bg-slate-100 hover:text-black' }}">
                            Companies
                        </a>
                        <a href="{{ route('employees.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('employees.*') ? 'bg-black text-white shadow-lg' : 'text-slate-600 hover:bg-slate-100 hover:text-black' }}">
                            Employees
                        </a>
                    </nav>
                </div>

                <div class="p-4 border-t border-slate-200">
                    <div class="px-4 py-3 text-sm text-slate-500">
                        Logged in as:<br>
                        <span class="text-black font-medium truncate block">{{ Auth::user()->email }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 mt-2 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="relative z-10 flex-1 flex flex-col overflow-hidden">
                <div id="swup-header" class="transition-fade">
                    @isset($header)
                        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 h-20 flex items-center px-8">
                            <div class="w-full flex justify-between items-center text-slate-900">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset
                </div>

                <main id="swup-main" class="flex-1 overflow-y-auto p-8 transition-fade">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const swup = new Swup({
                    containers: ['#swup-sidebar', '#swup-header', '#swup-main']
                });
            });
        </script>
    </body>
</html>
