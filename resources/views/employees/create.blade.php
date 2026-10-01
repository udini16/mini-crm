<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('employees.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Add New Employee') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="absolute inset-0 bg-slate-50 -z-10"></div>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-2xl overflow-hidden border border-slate-100">
                <div class="p-8">
                    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" class="text-sm font-semibold text-slate-700" />
                                <x-text-input id="first_name" class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="e.g. John" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-sm text-red-500" />
                            </div>

                            <!-- Last Name -->
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" class="text-sm font-semibold text-slate-700" />
                                <x-text-input id="last_name" class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="text" name="last_name" :value="old('last_name')" required placeholder="e.g. Doe" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-sm text-red-500" />
                            </div>
                        </div>

                        <!-- Company -->
                        <div>
                            <x-input-label for="company_id" :value="__('Company')" class="text-sm font-semibold text-slate-700" />
                            <div class="relative mt-2">
                                <select id="company_id" name="company_id" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5 appearance-none bg-white" required>
                                    <option value="" disabled selected class="text-slate-400">Select a Company...</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('company_id')" class="mt-2 text-sm text-red-500" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-slate-700" />
                                <x-text-input id="email" class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="email" name="email" :value="old('email')" placeholder="e.g. john.doe@acme.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" class="text-sm font-semibold text-slate-700" />
                                <x-text-input id="phone" class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="tel" name="phone" :value="old('phone')" placeholder="e.g. +1 (555) 000-0000" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-500" />
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                            <a href="{{ route('employees.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                                Create Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
