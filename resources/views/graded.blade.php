@extends('layouts/public')

@section('content')
    
<div class="container py-5">
    <section class="single-quiz">

        <h1>Quiz: {{ $revision['details']['quiz_name'] }}</h1>
        @foreach ($revision['questions'] as $q => $a)
            {{ $q }}?
            
            @if ( $a['val'] == $a['ans'] )
                <b class="text-success">{{ $a['val'] }}</b> - <i class="fa-solid fa-circle-check text-success"></i> +<b>{{ $a['marks'] }}</b>
            @else
                <b class="text-danger">{{ $a['val'] }}</b> - <i class="fa-solid fa-circle-xmark text-danger"></i> +0
                <br>
                Answer: <b class="text-success">{{ $a['ans'] }}</b>
            @endif

            <hr>
        @endforeach
        <h4>Score: {{ $revision['score'] }}/{{ $revision['total'] }}</h4>

    </section>
</div>

@endsection