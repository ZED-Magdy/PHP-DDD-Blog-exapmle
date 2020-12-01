<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\Exception\CategoryNotFoundException;
use App\Domain\Blog\Exception\PostSlugAlreadyExistsException;
use App\Domain\Blog\Exception\PostTitleAlreadyExistsException;
use App\Domain\Blog\Exception\TagNotFoundException;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;

interface CreatePostServiceInterface
{
    /**
     * Undocumented function
     *
     * @param PostSlug $postSlug
     * @param PostTitle $postTitle
     * @param PostContent $postContent
     * @param CategoryId $categoryId
     * @param array $tags
     * @return Post
     * @throws PostSlugAlreadyExistsException
     * @throws PostTitleAlreadyExistsException
     * @throws CategoryNotFoundException
     * @throws TagNotFoundException
     */
    public function execute(PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, CategoryId $categoryId = null, array $tags = null): Post;
}
