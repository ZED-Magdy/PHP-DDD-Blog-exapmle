<?php

namespace App\Domain\Blog\Specification;

use App\Domain\Blog\ValueObject\PostTitle;

interface UniquePostTitleSpecificationInterface
{
    public function isUnique(PostTitle $postTitle): bool;
}
