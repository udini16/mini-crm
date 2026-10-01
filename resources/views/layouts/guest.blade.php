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
        </style>
    </head>
    <body class="font-['Playfair_Display'] text-slate-900 antialiased bg-slate-100">
        <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">
            <!-- Centered Box Container -->
            <div class="w-full max-w-5xl flex flex-col lg:flex-row bg-white rounded-2xl shadow-2xl overflow-hidden">
                
                <!-- Left Side: Image -->
                <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 min-h-[600px]">
                    <!-- Grayscale Background Image -->
                    <div class="absolute inset-0 bg-samurai grayscale z-0"></div>
                    <!-- Overlay to make text readable over the background -->
                    <div class="absolute inset-0 bg-black/40 z-0"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-transparent to-transparent z-0"></div>

                    <div class="relative z-10 flex flex-col justify-end p-10 w-full h-full text-white">
                        <img src="{{ asset('images/minicrm_logo.png') }}" alt="MiniCRM" class="h-14 w-auto object-contain invert opacity-90 mb-6 self-start" />
                        <h2 class="text-3xl lg:text-4xl font-bold leading-tight drop-shadow-md">
                            A streamlined, elegant solution<br>for managing your companies.
                        </h2>
                    </div>
                </div>

                <!-- Right Side: Form -->
                <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
                    <div class="w-full max-w-md">
                        <!-- Logo for mobile or desktop form header -->
                        <div class="flex justify-center mb-8">
                            <img src="{{ asset('images/minicrm_logo.png') }}" alt="MiniCRM" class="h-20 w-auto object-contain" />
                        </div>

                        <div class="mb-10 text-center">
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">Log in to your account</h1>
                            <p class="text-slate-600 font-sans text-sm">Welcome back! Please enter your details.</p>
                        </div>

                        {{ $slot }}
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
