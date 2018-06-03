<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Exercise;

class UpdateExercise extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $exercise = Exercise::find($this->route('exerciseId'));
        return $exercise && $this->user()->can('update', $exercise);
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
            'rep_max' => 'required|numeric|between:1,99999',
            'rep_max_interval' => 'required|numeric|between:1, 999'
        ];
    }
}
