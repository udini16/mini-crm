<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('employees.index') }}" class="text-slate-600 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Add New Employee') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-slate-200">
                <div class="p-8">
                    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" class="text-sm font-semibold text-slate-700">First Name <span class="text-red-500">*</span></x-input-label>
                                <x-text-input id="first_name" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="e.g. John" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-sm text-red-400" />
                            </div>

                            <!-- Last Name -->
                            <div>
                                <x-input-label for="last_name" class="text-sm font-semibold text-slate-700">Last Name <span class="text-red-500">*</span></x-input-label>
                                <x-text-input id="last_name" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="text" name="last_name" :value="old('last_name')" required placeholder="e.g. Doe" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-sm text-red-400" />
                            </div>
                        </div>

                        <!-- Company -->
                        <div x-data="{
                            open: false,
                            search: '',
                            selected: '{{ old('company_id') }}',
                            options: [
                                @foreach($companies as $company)
                                    { id: '{{ $company->id }}', name: '{{ addslashes($company->name) }}' },
                                @endforeach
                            ],
                            get filteredOptions() {
                                if (this.search === '') {
                                    return this.options;
                                }
                                return this.options.filter(i => i.name.toLowerCase().includes(this.search.toLowerCase()));
                            },
                            get selectedName() {
                                let opt = this.options.find(i => i.id == this.selected);
                                return opt ? opt.name : 'Select a Company...';
                            }
                        }" @click.outside="open = false" class="relative">
                            <x-input-label for="company_id" class="text-sm font-semibold text-slate-700">Company <span class="text-red-500">*</span></x-input-label>
                            <div class="relative mt-2">
                                <button type="button" @click="open = !open; if(open) setTimeout(() => $refs.search.focus(), 50)" class="flex items-center justify-between w-full border border-slate-300 bg-slate-50 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5 px-3 text-left transition-colors">
                                    <span x-text="selectedName" :class="selected ? 'text-slate-900' : 'text-slate-500'"></span>
                                    <svg class="h-4 w-4 text-slate-600 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                
                                <div x-show="open" x-transition.opacity class="absolute z-50 w-full mt-1 bg-slate-50 border border-slate-300 rounded-lg shadow-xl overflow-hidden">
                                    <div class="p-2 border-b border-slate-200 bg-slate-50">
                                        <input type="text" x-model="search" x-ref="search" class="w-full bg-white border-slate-300 text-slate-900 rounded-md text-sm py-1.5 px-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Search company...">
                                    </div>
                                    <ul class="max-h-48 overflow-y-auto bg-slate-50">
                                        <template x-for="option in filteredOptions" :key="option.id">
                                            <li @click="selected = option.id; open = false; search = ''" 
                                                class="px-3 py-2 cursor-pointer transition-colors text-sm"
                                                :class="selected == option.id ? 'bg-black text-black font-medium' : 'text-slate-700 hover:bg-slate-200'">
                                                <span x-text="option.name"></span>
                                            </li>
                                        </template>
                                        <li x-show="filteredOptions.length === 0" class="px-3 py-3 text-sm text-slate-500 text-center">No companies found</li>
                                    </ul>
                                </div>
                                <input type="hidden" name="company_id" x-model="selected" id="company_id">
                            </div>
                            <x-input-error :messages="$errors->get('company_id')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-slate-700" />
                                <x-text-input id="email" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="email" name="email" :value="old('email')" placeholder="e.g. john.doe@acme.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                            </div>

                            <!-- Phone -->
                            <div x-data="{
                                phoneValue: '{{ old('phone') }}'
                            }" x-init="
                                let iti = window.intlTelInput($refs.phone, {
                                    utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js',
                                    initialCountry: 'auto',
                                    geoIpLookup: function(callback) {
                                        fetch('https://ipapi.co/json').then(res => res.json()).then(data => callback(data.country_code)).catch(() => callback('us'));
                                    },
                                    showSelectedDialCode: true,
                                    nationalMode: true,
                                    dropdownContainer: document.body
                                });
                                
                                const updateHiddenPhone = () => {
                                    phoneValue = iti.getNumber();
                                };

                                $refs.phone.addEventListener('countrychange', updateHiddenPhone);
                                $refs.phone.addEventListener('input', updateHiddenPhone);
                                
                                // Set initial value if old('phone') exists
                                if (phoneValue) {
                                    iti.setNumber(phoneValue);
                                }
                            ">
                                <x-input-label for="phone_display" :value="__('Phone Number')" class="text-sm font-semibold text-slate-700" />
                                <div class="mt-2">
                                    <x-text-input id="phone_display" x-ref="phone" class="block w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="tel" />
                                </div>
                                <input type="hidden" name="phone" x-model="phoneValue">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-400" />
                            </div>
                        </div>

                        <div class="pt-6 flex items-center justify-end gap-4 border-t border-slate-200 mt-6">
                            <a href="{{ route('employees.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">
                                Cancel
                            </a>
                            <x-animated-submit id="createEmployeeSubmitBtn">
                                Create Employee
                            </x-animated-submit>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
