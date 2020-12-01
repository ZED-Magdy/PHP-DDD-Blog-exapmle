<?php

namespace App\Domain\Blog\Specification;

use App\Domain\Blog\ValueObject\TagName;

interface UniqueTagNameSpecificationInterface
{
    public function isUnique(TagName $tagName): bool;
}
