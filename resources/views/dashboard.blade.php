<x-app-layout>
    <x-slot name="header">
        <h2 class="font-['Playfair_Display'] text-2xl font-semibold">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white backdrop-blur-md border border-slate-200 overflow-hidden shadow-2xl sm:rounded-2xl">
                <div class="p-8 text-slate-900 text-lg">
                    {{ __("Welcome back! You're logged in.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
