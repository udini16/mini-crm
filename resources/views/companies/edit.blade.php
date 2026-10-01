<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('companies.index') }}" class="text-slate-600 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Edit Company') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-slate-200">
                <div class="p-8">
                    <form method="POST" action="{{ route('companies.update', $company) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Company Name')" class="text-sm font-semibold text-slate-700" />
                            <x-text-input id="name" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="text" name="name" :value="old('name', $company->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-slate-700" />
                            <x-text-input id="email" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="email" name="email" :value="old('email', $company->email)" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <!-- Website -->
                        <div>
                            <x-input-label for="website" :value="__('Website')" class="text-sm font-semibold text-slate-700" />
                            <x-text-input id="website" class="block mt-2 w-full border-slate-300 bg-slate-50 text-slate-900 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-2.5" type="url" name="website" :value="old('website', $company->website)" />
                            <x-input-error :messages="$errors->get('website')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <!-- Logo -->
                        <div x-data="{ 
                            previewUrl: null,
                            fileError: null,
                            handleFile(event) {
                                this.fileError = null;
                                let file = event.target.files[0];
                                if (!file) {
                                    this.previewUrl = null;
                                    return;
                                }
                                
                                if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
                                    this.fileError = 'File must be a JPG, PNG, or GIF.';
                                    event.target.value = '';
                                    this.previewUrl = null;
                                    return;
                                }
                                
                                if (file.size > 2 * 1024 * 1024) {
                                    this.fileError = 'File size must be less than 2MB.';
                                    event.target.value = '';
                                    this.previewUrl = null;
                                    return;
                                }

                                let img = new Image();
                                let objectUrl = URL.createObjectURL(file);
                                img.onload = () => {
                                    if (img.width < 100 || img.height < 100) {
                                        this.fileError = 'Image dimensions must be at least 100x100 pixels.';
                                        event.target.value = '';
                                        this.previewUrl = null;
                                    } else {
                                        this.previewUrl = objectUrl;
                                    }
                                };
                                img.src = objectUrl;
                            }
                        }">
                            <x-input-label for="logo" :value="__('Company Logo')" class="text-sm font-semibold text-slate-700 mb-2" />
                            
                            @if($company->logo)
                                <div class="mb-4 flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden border border-slate-300 bg-white shadow-sm flex-shrink-0">
                                        <img src="{{ Storage::url($company->logo) }}" alt="Current Logo" class="w-full h-full object-cover">
                                    </div>
                                    <div class="text-sm text-slate-600">
                                        <p class="font-medium text-slate-800">Current Logo</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Uploading a new one will replace this.</p>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors bg-slate-50 relative overflow-hidden group">
                                
                                <template x-if="previewUrl">
                                    <div class="absolute inset-0 z-10 w-full h-full flex items-center justify-center bg-white/90 backdrop-blur-sm">
                                        <img :src="previewUrl" class="max-h-full max-w-full object-contain p-2" />
                                        <button type="button" @click="previewUrl = null; $refs.logo.value = null; fileError = null" class="absolute top-2 right-2 p-1.5 bg-red-500/80 hover:bg-red-500 text-black rounded-full transition-colors shadow-lg opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                </template>

                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="logo" class="relative cursor-pointer bg-slate-200 rounded-md font-medium text-indigo-600 hover:text-indigo-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 px-3 py-1 mt-2">
                                            <span>Upload a new file</span>
                                            <input id="logo" x-ref="logo" @change="handleFile($event)" name="logo" type="file" class="sr-only" accept="image/png, image/jpeg, image/gif">
                                        </label>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">PNG, JPG, GIF up to 2MB (min 100x100)</p>
                                </div>
                            </div>
                            
                            <template x-if="fileError">
                                <p class="mt-2 text-sm text-red-400 font-medium" x-text="fileError"></p>
                            </template>
                            <template x-if="!fileError">
                                <x-input-error :messages="$errors->get('logo')" class="mt-2 text-sm text-red-400" />
                            </template>
                        </div>

                        <div class="pt-6 flex items-center justify-end gap-4 border-t border-slate-200 mt-6">
                            <a href="{{ route('companies.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">
                                Cancel
                            </a>
                            <x-animated-submit id="editCompanySubmitBtn">
                                Save Changes
                            </x-animated-submit>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
