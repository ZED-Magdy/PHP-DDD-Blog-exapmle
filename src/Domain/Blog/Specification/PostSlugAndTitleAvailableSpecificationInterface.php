<?php
namespace App\Domain\Blog\Specification;

use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;

interface PostSlugAndTitleAvailableSpecificationInterface
{
    public function isAvailable(PostSlug $postSlug, PostTitle $postTitle, PostId $postId);
}