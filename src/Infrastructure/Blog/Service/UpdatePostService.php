<?php

namespace App\Infrastructure\Blog\Service;

use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\Exception\PostNotFoundException;
use App\Domain\Blog\Repository\CategoryRepositoryInterface;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Repository\TagRepositoryInterface;
use App\Domain\Blog\Service\UpdatePostServiceInterface;
use App\Domain\Blog\Specification\PostSlugAndTitleAvailableSpecificationInterface;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\TagId;

class UpdatePostService implements UpdatePostServiceInterface
{
    private $postRepository;
    private $categoryRepository;
    private $tagRepository;
    private $specification;

    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository, PostSlugAndTitleAvailableSpecificationInterface $specification)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->specification = $specification;
    }
    public function execute(PostId $postId, PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, CategoryId $categoryId = null, array $tagsIds = null): bool
    {
        $post = $this->postRepository->fromId($postId);
        if ($post == null) {
            throw new PostNotFoundException("Cannot find post of id $postId->id()");
        }
        $this->specification->isAvailable($postSlug, $postTitle, $postId);

        if ($categoryId) {
            $category = $this->categoryRepository->fromId($categoryId);
        }
        if ($tagsIds) {
            $tags = [];
            foreach ($tagsIds as $tagId) {
                $tag = $this->tagRepository->fromId(
                    TagId::fromString($tagId)
                );
                $tags[] = $tag;
            }
        } else {
            $tags = null;
        }
        $post = $post->update($postSlug, $postTitle, $postContent, $category, $tags);

        $this->postRepository->save($post);

        return true;
    }
}
