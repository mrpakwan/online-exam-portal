<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Exams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($exams->count())
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">{{ __('Title') }}</th>
                                <th class="border px-4 py-2">{{ __('Subject') }}</th>
                                <th class="border px-4 py-2">{{ __('Duration (minutes)') }}</th>
                                <th class="border px-4 py-2">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td class="border px-4 py-2">{{ $exam->title }}</td>
                                    <td class="border px-4 py-2">{{ $exam->subject->name }}</td>
                                    <td class="border px-4 py-2">{{ $exam->duration }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('student.exam', $exam) }}"
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                            <i class="fas fa-pen-alt mr-1"></i> {{ __('Attempt') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">{{ __('No exams are currently available.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
