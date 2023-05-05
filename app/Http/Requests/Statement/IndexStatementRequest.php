<?php

namespace App\Http\Requests\Statement;

use App\Http\Requests\ListRequest;
use Illuminate\Support\Facades\Auth;

class IndexStatementRequest extends ListRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [];
    }
}
