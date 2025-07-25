<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Scores') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($exams as $exam)
                <div class="bg-white shadow sm:rounded-lg mb-6 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        {{ $exam->title }} ({{ $exam->subject->name }})
                    </h3>

                    @php
                        $students = $exam->questions
                            ->flatMap(fn($q) => $q->answers)
                            ->groupBy('user_id');
                    @endphp

                    @if ($students->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Student
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Score
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Percentage
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($students as $userId => $answers)
                                        @php
                                            $student = $answers->first()->user;
                                            $total = $exam->questions->count();
                                            $correct = $answers->filter(fn($a) =>
                                                $a->question->type === 'mcq' &&
                                                $a->answer_text === optional($a->question->options->firstWhere('is_correct', true))->option_text
                                            )->count();
                                            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-800">
                                                {{ $student->name }}
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-800">
                                                {{ $correct }} / {{ $total }}
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-800">
                                                {{ $percentage }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No submissions yet.</p>
                    @endif
                </div>
            @empty
                <div class="text-gray-500 text-center">No exams found.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
