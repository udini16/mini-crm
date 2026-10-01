<x-app-layout>
    <x-slot name="header">
        <h2 class="font-['Playfair_Display'] font-bold text-2xl text-white tracking-tight">
            {{ __('Employees') }}
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

            <div class="bg-slate-900/60 backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-slate-700/50">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/80 backdrop-blur-sm border-b border-slate-700/50">
                                <th class="px-6 py-4 text-xs font-semibold text-slate-300 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-300 uppercase tracking-wider">Company</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-300 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-300 uppercase tracking-wider text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        Actions
                                        <a href="{{ route('employees.create') }}" class="inline-block hover:scale-110 transition-transform bg-slate-700/50 p-1.5 rounded-lg border border-slate-600/50" title="Add Employee">
                                            <img src="{{ asset('images/add_employee.png') }}?v={{ time() }}" class="w-5 h-5 invert opacity-80 hover:opacity-100" alt="Add Employee">
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($employees as $employee)
                                <tr class="hover:bg-slate-800/50 transition-colors duration-150 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-slate-800 text-slate-300 border border-slate-700/50 flex items-center justify-center font-semibold text-sm shadow-inner">
                                                {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-semibold text-slate-100">{{ $employee->first_name }} {{ $employee->last_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($employee->company)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-800/80 text-slate-300 border border-slate-700/50">
                                                {{ $employee->company->name }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-500 italic">No Company</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col gap-1">
                                            @if($employee->email)
                                                <a href="mailto:{{ $employee->email }}" class="text-xs text-slate-300 hover:text-indigo-400 flex items-center gap-1.5 transition-colors">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                    {{ $employee->email }}
                                                </a>
                                            @endif
                                            @if($employee->phone)
                                                <a href="tel:{{ $employee->phone }}" class="text-xs text-slate-300 hover:text-indigo-400 flex items-center gap-1.5 transition-colors">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                    {{ $employee->phone }}
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="{{ route('employees.edit', $employee) }}" class="p-2 text-indigo-400 bg-indigo-500/10 hover:bg-indigo-500/20 rounded-lg transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
                                            <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </div>
                                            <p class="text-slate-300 font-medium mb-1">No employees found</p>
                                            <p class="text-sm text-slate-500 mb-4">Get started by adding a new employee.</p>
                                            <a href="{{ route('employees.create') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">Add your first employee &rarr;</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($employees->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30">
                        {{ $employees->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
