<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Exams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('lecturer.exams.create') }}"
                       class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                        <i class="fas fa-plus mr-2"></i> {{ __('Create New Exam') }}
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border">{{ __('Title') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border">{{ __('Subject') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border">{{ __('Duration') }}</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($exams as $exam)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $exam->title }}</td>
                                    <td class="px-4 py-2 border">{{ $exam->subject->name }}</td>
                                    <td class="px-4 py-2 border">{{ $exam->duration }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('lecturer.questions.index', $exam) }}"
                                           class="inline-flex items-center bg-indigo-600 text-white px-3 py-1.5 rounded text-sm hover:bg-indigo-700">
                                            <i class="fas fa-eye mr-1"></i> {{ __('View') }}
                                        </a>
                                        <a href="{{ route('lecturer.questions.create', $exam) }}"
                                           class="inline-flex items-center bg-yellow-500 text-white px-3 py-1.5 rounded text-sm hover:bg-yellow-600">
                                            <i class="fas fa-plus mr-1"></i> {{ __('Add Qs') }}
                                        </a>
                                        <a href="{{ route('lecturer.exams.export', $exam) }}"
                                           class="inline-flex items-center bg-green-500 text-white px-3 py-1.5 rounded text-sm hover:bg-green-600">
                                            <i class="fas fa-file-export mr-1"></i> {{ __('Export to Excel') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($exams->isEmpty())
                        <p class="text-center text-gray-500 mt-4">{{ __('No exams found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
