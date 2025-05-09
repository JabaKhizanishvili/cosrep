<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this->object) {
            return [
                'name' => 'required|min:2|max:255|unique:categories,name,' . $this->object->id,
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048'

            ];
        } else {
            return [
                'name' => 'required|min:2|max:255|unique:categories,name',
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048'
            ];
        }
    }
}
