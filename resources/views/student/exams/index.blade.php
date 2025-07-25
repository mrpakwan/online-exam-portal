<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Available Exams') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse ($exams as $exam)
                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition duration-200">
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ $exam->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $exam->subject->name }}</p>
                        <p class="text-sm text-gray-500">{{ __('Duration') }}: {{ $exam->duration }} {{ __('minutes') }}</p>
                    </div>

                    <div>
                        <a href="{{ route('student.exams.start', $exam) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Take Exam') }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 text-sm">
                    {{ __('You don’t have any available exams right now.') }}
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
