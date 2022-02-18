<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', // eg digital logic
        // 'cat', // category: eg math, science, history, business
        'timeout' // in minutes
    ];
    protected $hidden = [];
    public $timestamps = false;

    function questions () {
        return $this->hasMany(Question::class);
    }
}
