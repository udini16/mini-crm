<x-app-layout>
    <x-slot name="header">
        <h2 class="font-['Playfair_Display'] font-bold text-2xl text-black tracking-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms class="bg-emerald-900/50 backdrop-blur-sm border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm mb-6 flex justify-between items-start">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-emerald-100 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-300 focus:outline-none">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            @endif

            <div class="mb-6 flex justify-end">
                <form method="GET" action="{{ route('companies.index') }}" class="flex items-center gap-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm w-64 text-slate-700">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-slate-800 text-white font-medium rounded-lg text-sm hover:bg-slate-700 transition shadow-sm">Search</button>
                    @if(request('search'))
                        <a href="{{ route('companies.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-lg text-sm hover:bg-slate-200 transition border border-slate-200 shadow-sm">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 backdrop-blur-sm border-b border-slate-200">
                                <th class="px-6 py-4 text-xs font-semibold text-slate-700 uppercase tracking-wider">Logo</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-700 uppercase tracking-wider">Company Details</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-700 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-700 uppercase tracking-wider text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        Actions
                                        <a href="{{ route('companies.create') }}" class="inline-block hover:scale-110 transition-transform bg-slate-200/50 p-1.5 rounded-lg border border-slate-300/50" title="Add Company">
                                            <img src="{{ asset('images/add_company.png') }}" class="w-5 h-5 opacity-80 hover:opacity-100" alt="Add Company">
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($companies as $company)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($company->logo)
                                            <div class="w-12 h-12 rounded-xl border border-slate-200 bg-slate-50 overflow-hidden shadow-sm flex items-center justify-center">
                                                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center font-bold text-lg shadow-sm border border-slate-200">
                                                {{ substr($company->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-slate-900">{{ $company->name }}</span>
                                            @if($company->website)
                                                <a href="{{ $company->website }}" target="_blank" class="text-xs text-indigo-500 hover:text-indigo-700 hover:underline mt-0.5 inline-flex items-center">
                                                    {{ str_replace(['http://', 'https://'], '', $company->website) }}
                                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($company->email)
                                            <a href="mailto:{{ $company->email }}" class="text-sm text-slate-700 hover:text-indigo-600 flex items-center gap-1.5 transition-colors">
                                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ $company->email }}
                                            </a>
                                        @else
                                            <span class="text-sm text-slate-500 italic">No email</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="{{ route('companies.edit', $company) }}" class="p-2 text-indigo-600 bg-indigo-500/10 hover:bg-indigo-500/20 rounded-lg transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-400 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-colors" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            </div>
                                            <p class="text-slate-700 font-medium mb-1">No companies found</p>
                                            <p class="text-sm text-slate-500 mb-4">Get started by adding a new company.</p>
                                            <a href="{{ route('companies.create') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">Add your first company &rarr;</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($companies->hasPages())
                    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
                        {{ $companies->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
