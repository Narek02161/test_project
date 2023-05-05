<?php

namespace App\Http\Requests\Statement;

use Illuminate\Foundation\Http\FormRequest;

class ParentStatementRequest extends FormRequest
{
    protected const TITLE = 'title';
    protected const AUTHOR_NAME = 'author_name';
    protected const DATE_PUBLISHED = 'date_published';

    public function rules(): array
    {
        return [
            self::AUTHOR_NAME => [
                'string',
                'required',
            ],
            self::TITLE => [
                'string',
                'required',
            ],
            self::DATE_PUBLISHED => [
                'string',
                'required',
            ],
        ];
    }

    public function getUserId(): int
    {
        return $this->user()->id;
    }

    public function getAuthorName(): string
    {
        return $this->get(self::AUTHOR_NAME);
    }

    public function getTitle(): string
    {
        return $this->get(self::TITLE);
    }

    public function getDatePublished(): string
    {
        return $this->get(self::DATE_PUBLISHED);
    }
}
