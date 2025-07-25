@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manual Grading: {{ $exam->title }}</h2>

    @foreach ($answers as $questionId => $entries)
        <div class="card mb-4">
            <div class="card-header">
                <strong>Question:</strong> {{ $entries->first()->question->question_text }}
            </div>
            <div class="card-body">
                @foreach ($entries as $answer)
                    <div class="border p-3 mb-3">
                        <p><strong>Student:</strong> {{ $answer->student->name }}</p>
                        <p><strong>Answer:</strong><br>{{ $answer->answer_text }}</p>

                        <form method="POST" action="{{ route('answers.grade', $answer) }}">
                            @csrf
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_correct" value="1" {{ $answer->is_correct === true ? 'checked' : '' }}>
                                <label class="form-check-label">Correct</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_correct" value="0" {{ $answer->is_correct === false ? 'checked' : '' }}>
                                <label class="form-check-label">Incorrect</label>
                            </div>
                            <button class="btn btn-sm btn-primary ms-2">Save</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
