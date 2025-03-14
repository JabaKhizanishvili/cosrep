<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
                'name' => 'required|min:2|max:255|unique:organizations,name,' . $this->object->id,
                'text' => 'nullable|max:10000',
                'email' => 'required|max:255|email',
            ];
        } else {
            return [
                'name' => 'required|min:2|max:255|unique:organizations,name',
                'text' => 'nullable|max:10000',
                'email' => 'required|email|max:255',
            ];
        }
    }
}
