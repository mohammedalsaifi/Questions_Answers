<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Gate::authorize('tags.view');


        $tag = Tag::paginate();

        return view('tags.index', [
            'title' => 'Tags Title',
            'tags' => $tag,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        Gate::authorize('tags.create');
        return view('tags.create', [
            'tag' => new Tag(),
        ]);
    }

    public function store(TagRequest $request)
    {

        //$this->validateRequest($request);

        $tag = new Tag();

        $tag->name = $request->name;
        //$tag->slug = Str::slug($request->name);

        $tag->save();
        //PRG "post redirect get"
        return redirect('/tags');
    }

    public function edit($id)
    {
        Gate::authorize('tags.edit');
        //select * from tags where id = $id
        //$tag = Tag::where('id', '=', $id)->firstOrFail();
        $tag = Tag::findOrFail($id);
        /*
            if($tag == null){
                abort(404);     ===>>>  findOrFail "same output"
            }
        */

        return view('tags.edit', [
            'tag' => $tag,
        ]);
    }

    public function update(TagRequest $request, $id)
    {
        //$this->validateRequest($request,$id);

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        //$tag->slug = Str::slug($request->name);
        $tag->save();

        //PRG
        return redirect('/tags');
    }

    public function destroy($id)
    {
        Gate::authorize('tags.delete');

        // Tag::destory($id);
        // Tag::where('id', '=', $id)->delete();

        $tag = Tag::findOrFail($id);
        $tag->delete();

        //PRG
        return redirect('/tags');
    }

    protected function validateRequest(Request $request, $id = 0)
    {
        $request->validate([
            'name' => ['required', 'string', 'between:3,255', "unique:tags,name,$id"],
        ]);
    }
}
