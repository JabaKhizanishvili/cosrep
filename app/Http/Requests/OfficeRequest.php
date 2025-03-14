<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
                // 'name' => 'required|min:2|max:255|unique:offices,name,' . $this->object->id,
                'name' => 'required|min:2|max:255',
                'organization_id' => 'required|exists:organizations,id',
                'address' => 'required|min:2|max:255',


            ];
        } else {
            return [
                // 'name' => 'required|min:2|max:255|unique:offices,name',
                'name' => 'required|min:2|max:255',
                'organization_id' => 'required|exists:organizations,id',
                'address' => 'required|min:2|max:255',
            ];
        }
    }
}
