<?php

namespace Tests\Feature\Auth\Classes;

class AssertErrorJsonStructureKeys
{
    public function run(): array
    {
        return [
            'status',
            'errors' => [
                'message',
                'errors'
            ]
        ];
    }
}
