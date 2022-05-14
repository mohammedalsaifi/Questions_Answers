<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Arguments\UpdateModel;

class AnswersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'int', 'exists:questions,id'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $question = Question::findOrFail($request->input('question_id'));

        $answer = $question->answers()->create($request->all());

        return redirect()->route('questions.show', $question->id)
            ->with('success', 'Answer Added!');
    }

    public function best(Request $request, $id)
    {
        $answer = Answer::findORFail($id);
        $question = $answer->question;
        if ($question->user_id != Auth::id()) {
            abort(403);
        } {
            $question->answers()->Update([
                'best_answers' => 0
            ]);
            $answer->forceFill([
                'best_answers' => 1
            ])->save();
            return redirect()->route('questions.show', $answer->question->id)
            ->with('success', 'Answer marked as best!');
        }
    }
}
