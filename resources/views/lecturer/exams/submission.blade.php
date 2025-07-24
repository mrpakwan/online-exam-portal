@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Student Submissions for {{ $exam->title }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Correct Answers</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                @php
                    $correct = $student->answers->filter(fn($a) => $a->is_correct === true)->count();
                @endphp
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $correct }}/{{ $totalQuestions }}</td>
                    <td>{{ number_format(($correct / max(1, $totalQuestions)) * 100, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
