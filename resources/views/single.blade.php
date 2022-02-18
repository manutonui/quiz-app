@extends('layouts/public')

@section('content')
    
<div class="container py-5">
    <h1><b>QUIZ</b></h1>
    <section class="single-quiz">
        <h4>{{ $quiz->name }}</h4>

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
                    <input type="radio" name="ans_{{ $itm->id }}" value="{{$choice}}" /> {{$choice}}<br>
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