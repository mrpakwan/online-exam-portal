<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $exam->title }} - <strong>{{ __('Time Remaining:') }}</strong> <span id="timer"></span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('student.exam.submit', $exam) }}">
                    @csrf

                    @foreach ($exam->questions as $question)
                        <div class="mb-4">
                            <p><strong>Q{{ $loop->iteration }}:</strong> {{ $question->question_text }}</p>

                            @if ($question->type === 'mcq')
                                @foreach ($question->options as $option)
                                    <div>
                                        <label>
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->option_text }}">
                                            {{ $option->option_text }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <textarea name="answers[{{ $question->id }}]" class="form-control" rows="3"></textarea>
                            @endif
                        </div>
                    @endforeach

                    <div class="flex justify-end">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-semibold rounded-md hover:bg-gray-200">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                           </svg>
                           {{ __('Back') }}
                        </a>&nbsp;
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Countdown Timer Logic
        const endTime = new Date(new Date().getTime() + 30 * 60 * 1000).getTime();

        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = endTime - now;

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = `${minutes}m ${seconds}s`;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById("timer").innerHTML = "Time's up! Submitting...";
                document.querySelector("form").submit();
            }
        }, 1000);
    </script>

</x-app-layout>
