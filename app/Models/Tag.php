<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,  // related model
            'question_tag',   // pivod table
            'tag_id',         // F.K for current table
            'question_id',    // F.K for related table
            'id',             // P.K for current table
            'id'              // P.K for related table
        );
    }
}
