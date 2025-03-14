<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'name' => 'required|max:255|unique:services,name,' . $this->object->id,
                'text' => 'required|max:100000',
            ];
        } else {
            return [
                'name' => 'required|unique:services,name|max:255',
                'text' => 'required|max:100000',
            ];
        }
    }
}
