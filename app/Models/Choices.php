<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'allchoices', // string, comma separated
        'question_id',
        'correct_answer',
    ];
    protected $hidden = [
        'correct_answer',
    ];

}
