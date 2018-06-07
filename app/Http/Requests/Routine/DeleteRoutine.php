<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Routine;

class DeleteRoutine extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $routine = Routine::find($this->route('routineId'));
        return $routine && $this->user()->can('delete', $routine);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
