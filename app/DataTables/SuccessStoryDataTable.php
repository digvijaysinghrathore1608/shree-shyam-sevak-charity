<?php

namespace App\DataTables;

use App\Models\SuccessStory;

/**
 * Class SuccessStoryDataTable
 */
class SuccessStoryDataTable
{
    /**
     * @return mixed
     */
    public function get()
    {
        return SuccessStory::select('success_stories.*');
    }
}
