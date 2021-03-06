<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Exception\PostNotFoundException;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;

interface UpdatePostServiceInterface
{
    /**
     *
     * @param PostId $postId
     * @param PostSlug $postSlug
     * @param PostTitle $postTitle
     * @param PostContent $postContent
     * @param CategoryId $categoryId
     * @param array $tagsIds
     * @return boolean
     * @throws PostNotFoundException
     * @throws PostSlugAlreadyExistsException
     * @throws PostTitleAlreadyExistsException
     * @throws CategoryNotFoundException
     * @throws TagNotFoundException
     */
    public function execute(PostId $postId, PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, CategoryId $categoryId = null, array $tagsIds = null): bool;
}
