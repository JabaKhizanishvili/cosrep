<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                'name' => 'required|max:255',
                'username' => 'required|digits:11|unique:customers,username,' . $this->object->id,
                'email' => 'required|max:255|email',
                'office_id'      => 'required|integer|exists:offices,id',
                'position_id'      => 'required|integer|exists:positions,id',
                'password' => [
                    'nullable',
                    'min:8',
                    'max:16',
                    new StrongPassword()
                ],
            ];
        } else {
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'username' => 'required|unique:customers,username|digits:11',
                'office_id'      => 'required|integer|exists:offices,id',
                'position_id'      => 'required|integer|exists:positions,id',
                'password' => [
                    'nullable',
                    'min:8',
                    'max:16',
                    new StrongPassword()
                ],
            ];
        }
    }
}
