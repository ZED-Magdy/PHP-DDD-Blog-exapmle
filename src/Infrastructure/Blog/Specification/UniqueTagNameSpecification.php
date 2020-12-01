<?php

namespace App\Infrastructure\Blog\Specification;

use App\Domain\Blog\Specification\UniqueTagNameSpecificationInterface;
use App\Domain\Blog\ValueObject\TagName;

class UniqueTagNameSpecification implements UniqueTagNameSpecificationInterface
{

    public function isUnique(TagName $tagName): bool
    {
        return true;
    }
}
