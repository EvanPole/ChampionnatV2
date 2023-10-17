<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatcheRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equipe1' => 'required',
            'equipe2' => 'required',
            'date' => 'required|date',
            'but1' => 'nullable|integer',
            'but2' => 'nullable|integer',
        ];
    }
}
