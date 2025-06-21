<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{

    function scopeWithQuiz($query)
    {
        return $query->join('quizzes', 'quizzes.id', '=', 'records.quiz_id')
            ->select('records.*', 'quizzes.*');
    }

    function quiz()
    {
        return $this->belongsTo(quiz::class);
    }
}
