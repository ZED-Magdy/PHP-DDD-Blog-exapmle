<?php

namespace App\Infrastructure\Blog\Service;

use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\Repository\CategoryRepositoryInterface;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Repository\TagRepositoryInterface;
use App\Domain\Blog\Service\CreatePostServiceInterface;
use App\Domain\Blog\Specification\UniquePostSlugSpecificationInterface;
use App\Domain\Blog\Specification\UniquePostTitleSpecificationInterface;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\TagId;

class CreatePostService implements CreatePostServiceInterface
{
    private $postRepository;
    private $categoryRepository;
    private $tagRepository;
    private $uniquePostTitleSpecification;
    private $uniquePostSlugSpecification;

    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository, UniquePostTitleSpecificationInterface $uniquePostTitleSpecification, UniquePostSlugSpecificationInterface $uniquePostSlugSpecification)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->uniquePostTitleSpecification = $uniquePostTitleSpecification;
        $this->uniquePostSlugSpecification = $uniquePostSlugSpecification;
    }

    public function execute(PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, CategoryId $categoryId = null, array $tags = null): Post
    {
        $this->uniquePostTitleSpecification->isUnique($postTitle);
        $this->uniquePostSlugSpecification->isUnique($postSlug);

        if($categoryId) {
            $category = $this->categoryRepository->fromId($categoryId);
        }
        $post = new Post(
            $this->postRepository->nextIdentity(),
            $postSlug,
            $postTitle,
            $postContent,
            $category?? null
        );
        if($tags) {
            foreach ($tags as $tag) {
                $post->addTag(
                    $this->tagRepository->fromId(
                        TagId::fromString($tag['id'])
                    )
                );
            }
        }

        $this->postRepository->save($post);

        return $post;
    }
}
