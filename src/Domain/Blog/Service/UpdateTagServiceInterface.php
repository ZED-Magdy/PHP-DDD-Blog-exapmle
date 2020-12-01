<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Entity\Tag;
use App\Domain\Blog\Exception\TagNameAlreadyExistsException;
use App\Domain\Blog\Exception\TagNotFoundException;
use App\Domain\Blog\ValueObject\TagId;
use App\Domain\Blog\ValueObject\TagName;

interface UpdateTagServiceInterface
{
    /**
     *
     * @param TagId $tagId
     * @param TagName $tagName
     * @return boolean
     * @throws TagNotFoundException
     * @throws TagNameAlreadyExistsException
     */
    public function execute(TagId $tagId, TagName $tagName): bool;
}
