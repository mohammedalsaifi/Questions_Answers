<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::all();
        return $question;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tags.*' => ['required', 'int', 'exists:tags,id'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        DB::beginTransaction();
        try {
            $question = Question::create($request->all());
            $question->tags()->attach($request->input('tags'));
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return response()->json($question, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quesiton = Question::findOrFail($id);
        return $quesiton->load('tags', 'user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'status' => ['in:open,closed'],
            'tags' => ['sometimes', 'required', function ($attr, $value, $fail) { // this function check if the values in tags column same of the values which developer trying to insert via post man;
                $tags = explode(',', $value);
                $exists = Tag::whereIn('id', $tags)->pluck('id')->toArray();
                $result = array_intersect($exists, $tags);
                if (count($result) != count($tags)){
                    $fail('Invalid Tags');
                }
            }],
        ]);

        DB::beginTransaction();

        try {
            $question->update($request->all());

            $tags = explode(',', $request->input('tags')); //sendin tags value as an array//
            $question->tags()->sync($tags);                 //syncronization the questions with current time
            DB::commit();                                   //save
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return [
            'message' => 'Question Updated!',
            'question' => $question,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);
        return [
            'message' => 'Question Deleted!',
        ];
    }
}
