<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Scores') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($exams as $exam)
                <div class="bg-white shadow-sm sm:rounded-lg mb-6 p-6">
                    <h3 class="text-lg font-semibold mb-2">{{ $exam->title }} ({{ $exam->subject->name }})</h3>

                    @php
                        $students = $exam->questions
                            ->flatMap(fn($q) => $q->answers)
                            ->groupBy('user_id');
                    @endphp

                    @if ($students->isNotEmpty())
                        <table class="min-w-full table-auto border border-gray-300 mb-4">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-3 py-2">Student</th>
                                    <th class="border px-3 py-2">Score</th>
                                    <th class="border px-3 py-2">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <td class="border px-3 py-2">{{ $student->name }}</td>
                                        <td class="border px-3 py-2">{{ $correct }} / {{ $total }}</td>
                                        <td class="border px-3 py-2">{{ $percentage }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No submissions yet.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
