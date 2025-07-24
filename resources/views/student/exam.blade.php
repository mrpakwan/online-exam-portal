@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $exam->title }}</h2>
    <p><strong>Time Remaining:</strong> <span id="timer"></span></p>

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

        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>
</div>

<script>
    // Countdown Timer Logic
    const endTime = new Date("{{ $exam->end_time }}").getTime();

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
@endsection
