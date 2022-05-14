<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id', 'status'
    ];

    // One to Many relationhsips.
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // related model
            'question_tag', // pivot table
            'question_id',  // F.K for current table
            'tag_id',       // F.K for related table
            'id',           // P.K for current table
            'id'            // P.K for related table
        );
    }
}
