<?php
namespace App\Infrastructure\Blog\Specification;

use App\Domain\Blog\Exception\PostSlugAlreadyExistsException;
use App\Domain\Blog\Exception\PostTitleAlreadyExistsException;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Specification\PostSlugAndTitleAvailableSpecificationInterface;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use App\Domain\Blog\ValueObject\PostId;

class PostSlugAndTitleAvailableSpecification implements PostSlugAndTitleAvailableSpecificationInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;    
    }
    public function isAvailable(PostSlug $postSlug, PostTitle $postTitle, PostId $postId)
    {
        $isAvailable = $this->postRepository->isAvailable($postSlug, $postTitle, $postId);
        if(!$isAvailable) {
            throw new PostSlugAlreadyExistsException();
            throw new PostTitleAlreadyExistsException();
        }

        return true;
    }
}