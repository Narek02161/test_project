<?php

namespace App\Http\Requests\Statement;

use App\Models\Statement\Statement;

class UpdateStatementRequest extends ParentStatementRequest
{
    private const STATEMENT_ID = 'id';
    private const SOURCE_URL = 'source_url';
    private const DESCRIPTION = 'description';
    private const IS_PUBLISHED = 'is_published';
    private const SOURCE_TITLE = 'source_title';

    public function authorize(): bool
    {
        return $this->user()->can('update', [Statement::class, $this->getStatementId()]);
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            self::STATEMENT_ID => [
                'integer'
            ],
            self::SOURCE_URL => [
                'string',
                'nullable',
            ],
            self::DESCRIPTION => [
                'string',
                'nullable',
            ],
            self::IS_PUBLISHED => [
                'bool',
                'nullable',
            ],
            self::SOURCE_TITLE => [
                'string',
                'nullable',
            ],
        ]);
    }

    public function getStatementId(): int
    {
        return $this->route(self::STATEMENT_ID);
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
