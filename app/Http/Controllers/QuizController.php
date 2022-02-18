<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choices;

class QuizController extends Controller
{
    function createQuiz () {
        return view('auth/create');
    }

    function all_quizzes () {
        $quizzes = Quiz::all();
        return view('all')->with('quizzes', $quizzes);
    }

    function open_quiz ($id) {
        // dd();
        $quiz = Quiz::find($id);
        return view('single')->with('quiz', $quiz);
    }

    function grade_quiz (Request $req) {
        // get the quiz // get the questions
        $quiz = Quiz::find($req->quiz_id);
        $quiz_questions = $quiz->questions;
        $score = 0;
        $total = 0;
        $revision = [];
        foreach ($quiz_questions as $itm) {
            
            // foreach question, find the correct choice then compare with ans given
            $ans = trim($itm->choices->correct_answer, '*'); // correct ans

            $question_id = (string)$itm->id;
            $question = (string)$itm->query;
            $param = "ans_$question_id"; // req param to check
            $val = $req->$param; // answer
            $marks = $itm->marks;
            $total += $marks;

            $revision['questions'][$question] = [
                'ans' => $ans,
                'val' => $val,
                'marks' => $marks
            ];

            // add marks
            if ( $val == $ans ) {
                $score += $marks;
            }
            
            
            // return view('blade')->with([]);
        }
        $revision['total'] = $total;
        $revision['score'] = $score;
        $revision['details'] = [
            'quiz_name' => $quiz->name,
        ]; 
        // dd($revision);
        // get answers
        // compare
        // dd($revision);
        return view('graded')->with('revision', $revision);
    }

    function publishQuiz (Request $req) {
        // create quiz, take questions, publish, then publish its choices
        $quiz = Quiz::create([
            'name' => $req->quiz_name,
            'timeout' => $req->quiz_time,
        ]);

        $questions_arr = $req->questions;
        $marks_arr = $req->marks;

        for ($i=0; $i < count($questions_arr); $i++) {
            // publish question
            $question = Question::create([
                'query' => $questions_arr[$i],
                'marks' => $marks_arr[$i],
                'quiz_id' => $quiz->id,
            ]);

            // publish choices now,         
            $choices_arr = explode(',', trim($req->choices[$i], ','));
            $clean_choices = "";
            $correct_ans = "";
            foreach ($choices_arr as $choice) {
                $single_choice = trim($choice);
                // add to clean_choices
                if ( str_contains($single_choice, '*') ) { $single_choice = trim($single_choice, '*'); $correct_ans = $single_choice; }
                $clean_choices .= "$single_choice,";
            }
            Choices::create([
                'allchoices' => trim($clean_choices,','),
                'question_id' => $question->id,
                'correct_answer' => $correct_ans,
            ]);
            
        }

        return redirect('/')->with('msg', 'Quiz created!');
    }
}
