<?php

namespace App\Http\Requests\Statement;

use Illuminate\Support\Facades\Auth;

class CreateStatementRequest extends ParentStatementRequest
{
    private const SOURCE_URL = 'source_url';
    private const DESCRIPTION = 'description';
    private const IS_PUBLISHED = 'is_published';
    private const SOURCE_TITLE = 'source_title';

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            self::DESCRIPTION => [
                'string',
            ],
            self::SOURCE_URL => [
                'string',
            ],
            self::SOURCE_TITLE => [
                'string',
            ],
            self::IS_PUBLISHED => [
                'bool',
            ],
        ]);
    }

    public function getDescription(): ?string
    {
        return $this->get(self::DESCRIPTION);
    }

    public function getSourceUrl(): ?string
    {
        return $this->get(self::SOURCE_URL);
    }

    public function getSourceTitle(): ?string
    {
        return $this->get(self::SOURCE_TITLE);
    }

    public function getIsPublished(): ?bool
    {
        return $this->get(self::IS_PUBLISHED);
    }
}
