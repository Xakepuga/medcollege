<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryFormRequest extends FormRequest
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
     * @param Request $request
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $tableId = $request->query('table');
        $tableName = DB::table('categories')->where('id', $tableId)->first()->table;

        return [
            'newItem' => [
                'string', 'between:2,100', 'required',
                Rule::unique($tableName, 'name')->ignore($this->id),
            ],
            'table' => 'integer|between:1,100|required',
        ];
    }

    /**
     * [Method description].
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'newItem' => '«Новый элемент»',
        ];
    }
}
