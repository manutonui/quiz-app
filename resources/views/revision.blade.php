@extends('layouts/public')

@section('content')
    
<div class="container py-5">
    <section class="single-quiz">
        <h1>Quiz: {{ $quiz->name }}</h1>

        <form action="/submit_quiz" method="post">

            @csrf

            @foreach ($quiz->questions as $itm)
                {{ $itm->query }} <br>
                <?php
                    // Shuffle the choices
                    $choices_array = explode( ',', $itm->choices->allchoices);
                    shuffle($choices_array);
                ?>
                @foreach ($choices_array as $choice)
                    <input type="radio" name="ans_{{ $itm->id }}" value="{{ trim($choice, '*') }}" /> {{ trim($choice, '*') }}<br>
                @endforeach
                <hr>
                {{-- <a href="/quiz/{{ $itm->id }}">{{ $itm->name }}</a><br> --}}
            @endforeach
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

            <input type="submit" class="btn btn-info">
        </form>
    </section>
</div>

@endsection