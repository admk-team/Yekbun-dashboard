<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable',
            'description' => 'nullable',
            'event_category_id' => 'nullable',
            'user_id' => 'nullable',
            'start_time' => 'nullable',
            "end_time" => 'nullable',
            "location" => 'nullable',
            "status" => 'nullable',
        ];
    }
}
