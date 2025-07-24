@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Result for: {{ $exam->title }}</h2>
    <p>Your Score: <strong>{{ $score }}/{{ $total }}</strong></p>

    <hr>

    @foreach ($answers as $question)
        <div>
            <p><strong>Q{{ $loop->iteration }}:</strong> {{ $question->question_text }}</p>
            <p>
                <strong>Your Answer:</strong>
                {{ $question->answers->first()?->answer_text ?? 'Not Answered' }}
                @if ($question->type === 'mcq')
                    @if ($question->answers->first()?->is_correct)
                        ✅
                    @else
                        ❌
                    @endif
                @endif
            </p>
        </div>
        <hr>
    @endforeach
</div>
@endsection
