@extends('layouts/public')

@section('content')
    
<div class="container py-5">
    <section class="quiz-form">
        <h1>Create Quiz</h1>
        <hr/>
        <form action="/create" method="post" id="" class="createQuizForm">
            @csrf
            <input placeholder="Quiz Name" name="quiz_name"><br>
            <input type="number" name="quiz_time" placeholder="Time"><br>
            <hr>
            <button onclick="add_new_query()" class="btn btn-success" id="add_query" type="button">Add Question</button>
            <input type="submit" value="Publish Quiz" class="btn btn-primary" />
            <hr>
            <div class="instructions">
                - Append an asterisk '*' before the correct choice<br>
                - E.g Question: 1+1, Choices: 11, *2, 0, 1
            </div>
            <hr>
            <div id="quizForm">
                
            </div>
            
        </form>
        
    </section>
</div>

@endsection



{{-- JAVASCRIPT --}}
<script>

    function add_new_query () {
        var quiz_form = document.getElementById('quizForm')
        quiz_form.appendChild(add_new_question_dom())
    }
    function add_new_question_dom () {
        var questions = document.getElementsByClassName('singleQuestion')
        var query_div = document.createElement('div')
        var noo = questions.length + 1
        query_div.classList.add("singleQuestion")
        query_div.innerHTML = `
        <span class="the_numbering">${noo}.</span>
        <input placeholder="write question here" name="questions[]" /> -
        <input placeholder="write answer here" name="choices[]" />
        <input placeholder="_ marks" name="marks[]" />
        <button onclick="delItm(event)" type="button" class="btn-sm btn-danger delete-query-btn">Delete</button>
        <hr>`

        return query_div
    }


    function delItm(e) {
        let parent = e.target.parentElement
        parent.remove()
        console.log("Parent element discarded: ", parent)
        reNo()
    }


    function reNo () {
        // console.log("renumbering...")
        var qs = document.getElementsByClassName("singleQuestion")
        console.log("All: ",qs )
        for ( let i = 0; i<qs.length; i++ ) {
            // var the_numbering = qs[i].getElementsByClassName('the_numbering')
            qs[i].getElementsByClassName('the_numbering')[0].innerHTML = i+1
            console.log("Updated")
            // the_numbering[i].innerHTML = i + 1
        }
    }

</script>