<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Entity\Tag;
use App\Domain\Blog\Exception\TagNameAlreadyExistsException;
use App\Domain\Blog\ValueObject\TagId;
use App\Domain\Blog\ValueObject\TagName;

interface CreateTagServiceInterface
{
    /**
     *
     * @param TagId $tagId
     * @param TagName $tagName
     * @return Tag
     * @throws TagNameAlreadyExistsException
     */
    public function execute(TagId $tagId, TagName $tagName): Tag;
}
