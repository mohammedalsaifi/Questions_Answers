<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        return [
            'name' => ['required', 'string', 'between:3,255', "unique:tags,name, $id"],
            'slug' => ['required'],
        ];
    }

    // public function messages()
    // {
    //     return[
    //         'required' => ':attribute هذا الحقل مطلوب يما!',
    //         'unique' => ':attribute بتستهبل يعني؟!',
    //     ];
    // }
}
