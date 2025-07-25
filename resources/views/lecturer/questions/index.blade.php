<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions for Exam: ') . $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('lecturer.questions.create', $exam) }}"
                       class="inline-flex items-center mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                        <i class="fas fa-plus mr-2"></i> {{ __('Add New Question') }}
                    </a>

                    @if($exam->questions->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">#</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Type</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Question</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Options</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Correct</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($exam->questions as $index => $question)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 border">{{ question_type_label($question->type) }}</td>
                                            <td class="px-4 py-2 border">{{ $question->question_text }}</td>
                                            <td class="px-4 py-2 border">
                                                @if ($question->type === 'mcq')
                                                    <ul class="list-disc pl-5 space-y-1">
                                                        @foreach ($question->options as $option)
                                                            <li>{{ $option->option_text }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-gray-400 italic">N/A</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 border">
                                                @if ($question->type === 'mcq')
                                                    <span class="font-semibold text-green-600">
                                                        {{ optional($question->options->firstWhere('is_correct', true))->option_text }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400 italic">N/A</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 border">
                                                <a href="{{ route('lecturer.questions.edit', [$exam, $question]) }}"
                                                   class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 mt-4">{{ __('No questions found for this exam.') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
