@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Exam Results</h2>
    <ul>
        @foreach($exams as $exam)
            <li>
                <a href="{{ route('lecturer.results.exam', $exam) }}">{{ $exam->title }}</a> - {{ $exam->subject->name }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
