<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>
            <a href="{{ route('employees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Employee
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-no-wrap w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-left font-bold">
                                <th class="border px-6 py-4">First Name</th>
                                <th class="border px-6 py-4">Last Name</th>
                                <th class="border px-6 py-4">Company</th>
                                <th class="border px-6 py-4">Email</th>
                                <th class="border px-6 py-4">Phone</th>
                                <th class="border px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="border px-6 py-4">{{ $employee->first_name }}</td>
                                    <td class="border px-6 py-4">{{ $employee->last_name }}</td>
                                    <td class="border px-6 py-4">{{ $employee->company->name ?? 'N/A' }}</td>
                                    <td class="border px-6 py-4">{{ $employee->email }}</td>
                                    <td class="border px-6 py-4">{{ $employee->phone }}</td>
                                    <td class="border px-6 py-4">
                                        <a href="{{ route('employees.edit', $employee) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
