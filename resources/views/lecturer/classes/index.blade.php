<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Class Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <a href="{{ route('lecturer.classes.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    + {{ __('Create New Class') }}
                </a>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Name') }}</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Students') }}</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                           @forelse ($classGroups as $group)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $group->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $group->students->count() }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 space-x-2">
                                        <a href="{{ route('lecturer.classes.edit', $group) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">
                                            <i class="fas fa-edit mr-1"></i> {{ __('Edit') }}
                                        </a>

                                        <a href="{{ route('lecturer.classes.assign', $group) }}"
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                                            <i class="fas fa-user-plus mr-1"></i> {{ __('Assign Students') }}
                                        </a>
                                    </td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-center">
                                    {{ __('No subjects found.') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
