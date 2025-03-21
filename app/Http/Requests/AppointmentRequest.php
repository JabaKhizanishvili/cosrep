<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        $after_date = date("Y-m-d H:i", strtotime("+1 day"));
        return [
            'training_id' => 'required|exists:trainings,id',
            'name' => 'required|max:255',
//            'start_date' => 'required|date_format:Y-m-d H:i|after:' . $after_date,
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i',
//            'duration' => 'required|integer|min:1',

            'repeat' => 'nullable|integer|min:1|max:24',
        ];
    }
}
