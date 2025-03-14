<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            "stat_list"    => "nullable|array|min:1|max:20",
            "stat_list.*"  => "nullable|string|min:1|max:255",
            "url"  => "nullable|url|min:1|max:255",

            "stat_icon"    => "required_if:section_id,2|array|min:3|max:3",
            "stat_number"    => "required_if:section_id,2|array|min:3|max:3",
            "stat_name"    => "required_if:section_id,2|array|min:3|max:3",

            "stat_icon.*"  => "required_if:section_id,2|string|min:1|max:255",
            "stat_name.*"  => "required_if:section_id,2|string|min:1|max:255",
            "stat_number.*"  => "required_if:section_id,2|numeric|min:1|max:99999",
        ];
    }
}
