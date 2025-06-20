<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCQ_Records extends Model
{
    protected $table = 'mcq_records';

    function scopeWithMCQ($query)
    {
        return $query->join('mcqs', 'mcq_records.mcq_id', '=', 'mcqs.id')->select('mcq_records.*', 'mcqs.question');
    }
}
