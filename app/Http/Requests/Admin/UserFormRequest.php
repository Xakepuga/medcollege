<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'alpha_dash|between:2,30|required',
            'surname' => 'alpha_dash|between:2,30|required',
            'email' => [
                Rule::unique('users')->ignore($this->id),
                'email:rfc', 'required'
            ],
            'isAdmin' => 'integer|min:0|max:1|required',
            'password' => [
                request()->is('register') ? 'required' : 'nullable',
                'string', 'min:8', 'confirmed'
            ],
        ];
    }
}
