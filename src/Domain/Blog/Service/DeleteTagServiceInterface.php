<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Exception\TagNotFoundException;
use App\Domain\Blog\ValueObject\TagId;

interface DeleteTagServiceInterface
{
    /**
     * Undocumented function
     *
     * @param TagId $tagId
     * @return void
     * @throws TagNotFoundException
     */
    public function execute(TagId $tagId): void;
}
