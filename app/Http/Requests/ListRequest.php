<?php

namespace App\Http\Requests;

use App\Traits\GetSortTrait;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    use GetSortTrait;

    protected const PER_PAGE_DEFAULT = 100;

    protected const PAGE = 'page';
    protected const SORTS = 'sort';
    protected const QUERY = 'query';
    protected const LIMIT = 'limit';
    protected const PER_PAGE = 'perPage';
    protected const SORTS_KEY = 'sort.key.*';
    protected const SORTS_VALUE = 'sort.value.*';

    public function rules(): array
    {
        return [
            self::PER_PAGE => $this->getPerPageRule(),
            self::PAGE => [
                'integer',
                'nullable',
            ],
            self::QUERY => [
                'string',
                'nullable',
            ],
            self::LIMIT => $this->getPerPageRule(),
            self::SORTS => [
                'array',
                'nullable',
            ],
            self::SORTS_KEY => [
                'string',
                'nullable',
            ],
            self::SORTS_VALUE => [
                'string',
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }

    public function getPage(): int
    {
        return $this->get(self::PAGE) ?? 1;
    }

    public function getPerPage(): int
    {
        return $this->get(self::PER_PAGE) ?? $this->get(self::LIMIT) ?? self::PER_PAGE_DEFAULT;
    }

    public function getQ(): ?string
    {
        return $this->get(self::QUERY);
    }

    public function getSort(): ?array
    {
        $sort = $this->get(self::SORTS);

        return $this->transformSortKey($sort);
    }

    private function getPerPageRule(): string
    {
        return 'integer|max:100|min:10';
    }
}
