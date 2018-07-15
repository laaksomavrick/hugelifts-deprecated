<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Routine;

class CreateRoutine extends FormRequest
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
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
            'days' => 'required|array',
            'days.*.exercises' => 'required|array',
            'days.*.exercises.*.sets' => 'required|array'
        ];
    }
}
