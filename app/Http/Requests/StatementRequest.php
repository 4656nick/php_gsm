<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatementRequest extends FormRequest
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
            'fio' => 'nullable',
            'date_of_create' => 'date|nullable',
            'stamp' => 'nullable',
            'numbers' => 'nullable',
            'gas' => 'required',
            'tanker_id' => 'required|exists:tankers,id',
            'sheet_id' => 'required|exists:sheets,id',
            'fuel_id' => 'required|exists:fuels,id',
            'garage_id' => 'required|exists:garages,id'
        ];
    }
}