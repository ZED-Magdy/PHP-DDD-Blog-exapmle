<?php

namespace App\Domain\Blog\Repository;

use App\Domain\Blog\Entity\Tag;
use App\Domain\Blog\ValueObject\TagId;

interface TagRepositoryInterface
{
    public function nextIdentity(): TagId;
    public function fromId(TagId $tagId): Tag;
    public function listTags($options, int $page, int $limitPerPage);
    public function save(Tag $tag): void;
}
