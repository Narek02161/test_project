<?php

namespace Tests\Feature\Statement\Classes;

class GetStatementJsonStructureKeys
{
    public static function createStatementJsonStructureKeys(): array
    {
        return [
            'title',
            'owner_id',
            'source_url',
            'description',
            'author_name',
            'is_published',
            'source_title',
            'date_published',
        ];
    }

    public static function indexStatementJsonStructureKeys(): array
    {
        return [
            'title',
            'source_url',
            'description',
            'author_name',
            'is_published',
            'source_title',
            'date_published',
        ];
    }
}
