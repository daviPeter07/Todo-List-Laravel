<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReorderTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /*
        schema de validacao,
        task (array), task id e position sao obrigatorio
        id tem que existir
        posicao no minimo zero
        */
    public function rules(): array
    {
        return [
            'tasks' => ['required', 'array'],
            'tasks.*.id' => ['required', 'integer', 'exists:tasks,id'],
            'tasks.*.position' => ['required', 'integer', 'min:0'],
        ];
    }
}
