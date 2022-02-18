@extends('layouts/public')

@section('content')
    
<div class="container py-5">
    <section class="all-quizzes">
        <h1>All Quizzes</h1>
        @if ( count($quizzes) )
            @foreach ($quizzes as $itm)
                <a href="/quiz/{{ $itm->id }}">{{ $itm->name }}</a><br>
            @endforeach
        @else
            <hr>
            <h4>No quiz to attempt</h4>
            <a href="/">Go Home >></a>
        @endif
    </section>
</div>

@endsection