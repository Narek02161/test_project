<?php

namespace App\Http\Requests\Statement;

use App\Models\Statement\Statement;
use Illuminate\Foundation\Http\FormRequest;

class DeleteStatementRequest extends FormRequest
{
    private const STATEMENT_ID = 'id';

    public function authorize(): bool
    {
        return $this->user()->can('delete', [Statement::class, $this->getStatementId()]);
    }

    public function rules(): array
    {
        return  [
            self::STATEMENT_ID => [
                'integer'
            ],
        ];
    }

    public function getStatementId(): int
    {
        return $this->route(self::STATEMENT_ID);
    }
}
