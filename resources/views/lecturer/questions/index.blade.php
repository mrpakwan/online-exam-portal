<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions for Exam: ') . $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('lecturer.questions.create', $exam) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm mb-4 inline-block">
                        {{ __('Add New Question') }}
                    </a>

                    @if($exam->questions->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">#</th>
                                        <th class="border border-gray-300 px-4 py-2">{{ __('Type') }}</th>
                                        <th class="border border-gray-300 px-4 py-2">{{ __('Question') }}</th>
                                        <th class="border border-gray-300 px-4 py-2">{{ __('Options') }}</th>
                                        <th class="border border-gray-300 px-4 py-2">{{ __('Correct') }}</th>
                                        <th class="border border-gray-300 px-4 py-2">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam->questions as $index => $question)
                                        <tr class="hover:bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ strtoupper($question->type) }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $question->question_text }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                @if ($question->type === 'mcq')
                                                    <ul class="list-disc pl-5">
                                                        @foreach ($question->options as $option)
                                                            <li>{{ $option->option_text }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                @if ($question->type === 'mcq')
                                                    {{ optional($question->options->firstWhere('is_correct', true))->option_text }}
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <a href="{{ route('lecturer.questions.edit', [$exam, $question]) }}" class="text-yellow-600 hover:underline text-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No questions found for this exam.') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
