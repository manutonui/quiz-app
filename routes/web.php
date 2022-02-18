<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// Creating and Managing quizzes
Route::get('/create', 'QuizController@createQuiz');
Route::post('/create', 'QuizController@publishQuiz');

// Attempting quizzes
Route::get('/attempt', 'QuizController@all_quizzes');
Route::get('/quiz/{id}', 'QuizController@open_quiz');

// Submission
Route::post('/submit_quiz', 'QuizController@grade_quiz');
