<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
        if (isset($this->object)) {
            return [
                'name' => 'required|max:255|unique:trainings,name,' . $this->object->id,
                'text' => 'nullable|max:10000',
                'trainer_id' => 'required|exists:trainers,id',
                'category_id' => 'required|exists:categories,id',
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048',
                'point_to_pass' => 'required|integer|min:1',
                "names"    => "nullable|array|min:1",
                "names.*"  => "nullable|string|min:1",
                "urls"    => "nullable|array|min:1",
                "urls.*"  => "nullable|url|min:1",

            ];
        } else {
            return [
                'name' => 'required|unique:trainings,name|max:255',
                'text' => 'nullable|max:10000',
                'trainer_id' => 'required|exists:trainers,id',
                'category_id' => 'required|exists:categories,id',
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:2048',
                'point_to_pass' => 'required|integer|min:1',
                "names"    => "nullable|array|min:1",
                "names.*"  => "nullable|string|min:1",
                "urls"    => "nullable|array|min:1",
                "urls.*"  => "nullable|url|min:1",
            ];
        }
    }
}
