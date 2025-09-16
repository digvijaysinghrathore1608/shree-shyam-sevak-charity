<?php

namespace App\Repositories;

use App\Models\Page;

/**
 * Class EventRepository
 */
class PageRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
        'description',
        'status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Page::class;
    }
}
