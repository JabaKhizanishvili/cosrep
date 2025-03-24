<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
        return [
            'title' => 'required|min:2|max:255',
            'text' => 'required|min:2|max:500000',
            'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:5000',
            "stat_icon" => "required|array|min:3|max:3",
            "stat_number" => "required|array",
//            "stat_name" => "required|array|min:3|max:3",

            "stat_icon.*" => "required|string|min:1|max:255",
//            "stat_name.*" => "required|string",
            "stat_number.*" => "required|numeric|min:1|max:10000",

        ];
    }
}
