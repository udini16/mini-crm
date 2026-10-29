<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div class="font-sans">
            <div class="flex items-center justify-between mb-1">
                <x-input-label for="email" :value="__('Email')" class="text-slate-800 font-bold" />
                <span class="text-[11px] text-slate-500">
                    Demo: <button type="button" onclick="document.getElementById('email').value='admin@admin.com'" class="font-mono text-indigo-600 font-semibold hover:underline cursor-pointer" title="Click to fill">admin@admin.com</button>
                </span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="admin@admin.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 font-sans">
            <div class="flex items-center justify-between mb-1">
                <x-input-label for="password" :value="__('Password')" class="text-slate-800 font-bold" />
                <span class="text-[11px] text-slate-500">
                    Demo: <button type="button" onclick="document.getElementById('password').value='password'" class="font-mono text-indigo-600 font-semibold hover:underline cursor-pointer" title="Click to fill">password</button>
                </span>
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center font-sans">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col mt-6 font-sans">
            <button type="submit" class="button-54 w-full !text-center">
                {{ __('Log in') }}
            </button>
            
            <div class="mt-6 text-center">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-slate-600 hover:text-slate-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>
