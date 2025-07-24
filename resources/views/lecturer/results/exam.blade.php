@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Results for: {{ $exam->title }}</h2>
    <p>Subject: {{ $exam->subject->name }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Answered</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->answers->count() }}</td>
                    <td>{{ $totalQuestions }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
