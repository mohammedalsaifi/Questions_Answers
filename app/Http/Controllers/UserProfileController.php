<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('user-profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'birthday' => ['date', 'before:today'],
            // 'email' => [
            //     'email',
            //     Rule::unique('users', 'email')->ignore($user->id)
            // ],
            'profile_photo' => [
                'nullable',
                'image',
                'dimensions:min_width=200,min_height=200',
                'max:521000'
            ],
        ]);

        $previus = $user->profile_photo_path;
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('/profile-photo', [
                'disk' => 'public',
            ]);
            $request->merge([
                'profile_photo_path' => $path,
            ]);
        }

        $user->update($request->all());

        $user->profile()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'birthday' => $request->input('birthday'),
        ]);
        if ($previus && $previus != $user->profile_photo_path) {
            Storage::disk('public')->delete($previus);
        }

        return redirect()
            ->route('profile')
            ->with('success', 'Profile Updated!');
    }
}