<?php

namespace App\Infrastructure\Blog\Specification;

use App\Domain\Blog\Exception\PostTitleAlreadyExistsException;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Specification\UniquePostTitleSpecificationInterface;
use App\Domain\Blog\ValueObject\PostTitle;

class UniquePostTitleSpecification implements UniquePostTitleSpecificationInterface
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     *
     * @param PostTitle $postTitle
     * @return boolean
     * @throws PostTitleAlreadyExistsException
     */
    public function isUnique(PostTitle $postTitle): bool
    {
        $post = $this->postRepository->fromTitle($postTitle);

        if ($post != null) {
            throw new PostTitleAlreadyExistsException();
        }

        return true;
    }
}
