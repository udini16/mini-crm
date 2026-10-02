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
            window.initAnimatedButtons = function() {
                document.querySelectorAll('.anim-btn-container').forEach(function(container) {
                    if (container.dataset.initialized) return;
                    container.dataset.initialized = 'true';
                    
                    var button = container.querySelector(".anim-button");
                    var text = container.querySelector(".anim-text");
                    var progressBar = container.querySelector(".anim-progress-bar");
                    var checkEl = container.querySelector(".anim-check");
                    var crossEl = container.querySelector(".anim-cross");
                    var checkSvg = container.querySelector(".anim-success-svg");
                    var crossSvg = container.querySelector(".anim-error-svg");
                    
                    if (!button || !checkEl || !crossEl) return;

                    var checkOffset = anime.setDashoffset(checkEl);
                    checkEl.setAttribute("stroke-dashoffset", checkOffset);

                    var crossOffset = anime.setDashoffset(crossEl);
                    crossEl.setAttribute("stroke-dashoffset", crossOffset);

                    var isAnimating = false;

                    function createTimeline(isSuccess) {
                        var timeline = anime.timeline({
                            autoplay: false,
                            complete: function() {
                                if (isSuccess) {
                                    container.closest('form').submit();
                                } else {
                                    setTimeout(function() {
                                        anime({
                                            targets: [progressBar, crossSvg],
                                            opacity: 0,
                                            duration: 300,
                                            easing: 'linear',
                                            complete: function() {
                                                progressBar.style.width = '0px';
                                                progressBar.style.height = '6px';
                                                progressBar.style.borderRadius = '200px';
                                                progressBar.style.backgroundColor = '#71DFBE';
                                                progressBar.style.opacity = '1';
                                                
                                                button.style.width = '200px';
                                                button.style.height = '48px';
                                                button.style.borderRadius = '8px';
                                                button.style.backgroundColor = '#2B2D2F';
                                                button.style.opacity = '1';
                                                
                                                text.style.opacity = '1';
                                                
                                                crossSvg.style.opacity = '0';
                                                checkSvg.style.opacity = '0';
                                                crossEl.setAttribute("stroke-dashoffset", crossOffset);
                                                checkEl.setAttribute("stroke-dashoffset", checkOffset);
                                                
                                                isAnimating = false;
                                            }
                                        });
                                        
                                        anime({
                                            targets: [button, text],
                                            opacity: 1,
                                            duration: 300,
                                            delay: 300,
                                            easing: 'linear'
                                        });
                                    }, 1200);
                                }
                            }
                        });

                        timeline
                            .add({ targets: text, duration: 500, opacity: "0", easing: "easeOutQuad" })
                            .add({ targets: button, duration: 800, height: 6, width: 200, backgroundColor: "#2B2D2F", border: "0", borderRadius: 100 }, "-=300")
                            .add({ targets: progressBar, duration: 1000, width: 200, easing: "linear" })
                            .add({ targets: button, width: 0, duration: 1 })
                            .add({ targets: progressBar, width: 48, height: 48, delay: 200, duration: 600, borderRadius: 48, backgroundColor: isSuccess ? "#71DFBE" : "#EF4444" });

                        if (isSuccess) {
                            timeline.add({ targets: checkSvg, opacity: 1, duration: 10 })
                                    .add({ targets: checkEl, strokeDashoffset: [checkOffset, 0], duration: 400, easing: "easeInOutSine" });
                        } else {
                            timeline.add({ targets: crossSvg, opacity: 1, duration: 10 })
                                    .add({ targets: crossEl, strokeDashoffset: [crossOffset, 0], duration: 400, easing: "easeInOutSine" });
                        }

                        return timeline;
                    }

                    var successTimeline = createTimeline(true);
                    var errorTimeline = createTimeline(false);

                    function showCustomError(input, message) {
                        var existing = document.getElementById('custom-form-error');
                        if (existing) existing.remove();

                        var errorDiv = document.createElement('div');
                        errorDiv.id = 'custom-form-error';
                        errorDiv.innerHTML = '<svg style="width:16px;height:16px;color:#F87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> <span style="margin-left:6px;">' + message + '</span>';
                        
                        errorDiv.style.position = 'absolute';
                        errorDiv.style.backgroundColor = '#1E293B'; 
                        errorDiv.style.color = '#F87171'; 
                        errorDiv.style.border = '1px solid #334155'; 
                        errorDiv.style.padding = '8px 12px';
                        errorDiv.style.borderRadius = '8px';
                        errorDiv.style.fontSize = '13px';
                        errorDiv.style.fontWeight = '500';
                        errorDiv.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.5)';
                        errorDiv.style.zIndex = '1000';
                        errorDiv.style.display = 'flex';
                        errorDiv.style.alignItems = 'center';
                        errorDiv.style.opacity = '0';
                        errorDiv.style.transition = 'opacity 0.2s, transform 0.2s';
                        errorDiv.style.transform = 'translateY(-10px)';
                        
                        document.body.appendChild(errorDiv);

                        var rect = input.getBoundingClientRect();
                        errorDiv.style.top = (rect.bottom + window.scrollY + 8) + 'px';
                        errorDiv.style.left = (rect.left + window.scrollX) + 'px';

                        requestAnimationFrame(function() {
                            errorDiv.style.opacity = '1';
                            errorDiv.style.transform = 'translateY(0)';
                        });

                        input.focus();

                        var removeError = function() {
                            errorDiv.style.opacity = '0';
                            errorDiv.style.transform = 'translateY(-10px)';
                            setTimeout(function() { if (errorDiv.parentNode) errorDiv.remove(); }, 200);
                            input.removeEventListener('input', removeError);
                            input.removeEventListener('change', removeError);
                        };

                        input.addEventListener('input', removeError);
                        input.addEventListener('change', removeError);
                        setTimeout(removeError, 4000);
                    }

                    function handleClick(e) {
                        e.preventDefault();
                        if (isAnimating) return;
                        isAnimating = true;
                        
                        var form = container.closest('form');
                        if (form && !form.checkValidity()) {
                            errorTimeline.play();
                            
                            var elements = form.elements;
                            for (var i = 0; i < elements.length; i++) {
                                if (!elements[i].validity.valid) {
                                    var msg = elements[i].validationMessage || 'Please fill out this field.';
                                    showCustomError(elements[i], msg);
                                    break;
                                }
                            }
                        } else {
                            successTimeline.play();
                        }
                    }

                    button.addEventListener("click", handleClick);
                    button.addEventListener("keydown", function(e) {
                        if (e.key === "Enter" || e.key === " ") {
                            handleClick(e);
                        }
                    });
                });
            };

            document.addEventListener('DOMContentLoaded', () => {
                const swup = new Swup({
                    containers: ['#swup-sidebar', '#swup-header', '#swup-main']
                });
                window.initAnimatedButtons();
                swup.hooks.on('page:view', () => {
                    window.initAnimatedButtons();
                });
            });
        </script>
    </body>
</html>
