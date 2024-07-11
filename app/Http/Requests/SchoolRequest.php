<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'schoolName' => ['required', 'min:10'],
            'district' => ['required', 'min:4'],
            'schoolRegNo' => ['required', 'min:5'],
            'repName' => ['required', 'min:10'],
            'repEmail' => ['required', 'email', Rule::unique((new School)->getTable())->ignore(auth()->id())],
        ];
    }
}
