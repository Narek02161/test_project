<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ParentAuthRequest extends FormRequest
{
    protected const PASSWORD = 'password';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::PASSWORD => [
                'string',
                'required',
                'min:5',
            ],
        ];
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }
}
