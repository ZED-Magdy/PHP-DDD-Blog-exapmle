<?php
namespace App\Domain\Blog\Specification;

use App\Domain\Blog\Exception\PostSlugAlreadyExistsException;
use App\Domain\Blog\ValueObject\PostSlug;

interface UniquePostSlugSpecificationInterface
{
    /**
     *
     * @param PostSlug $postSlug
     * @return boolean
     * @throws PostSlugAlreadyExistsException
     */
    public function isUnique(PostSlug $postSlug): bool;
}