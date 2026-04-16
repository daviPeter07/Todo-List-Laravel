<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /*
        schema de validacao,
        titulo é obrigatorio, tem q ser string no max 255 caracteres
        desc pode ser null, tem q ser string
        status pode ser null, string e deve ser pendente ou completo
        */
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:pending,completed'],
        ];
    }
}
