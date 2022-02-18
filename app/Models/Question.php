<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'query',
        'marks',
        'quiz_id',
    ];
    protected $hidden = [
    ];

    public $timestamps = false;

    function choices () {
        return $this->hasOne(Choices::class);
    }
}
