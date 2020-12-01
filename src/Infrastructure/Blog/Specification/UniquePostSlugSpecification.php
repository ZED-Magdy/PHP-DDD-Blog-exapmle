<?php
namespace App\Infrastructure\Blog\Specification;

use App\Domain\Blog\Exception\PostSlugAlreadyExistsException;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Specification\UniquePostSlugSpecificationInterface;
use App\Domain\Blog\ValueObject\PostSlug;

class UniquePostSlugSpecification implements UniquePostSlugSpecificationInterface
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    /**
     *
     * @param PostSlug $postSlug
     * @return boolean
     * @throws PostSlugAlreadyExistsException
     */
    public function isUnique(PostSlug $postSlug): bool
    {
        $post = $this->postRepository->fromSlug($postSlug);

        if($post != null) {
            throw new PostSlugAlreadyExistsException();
        }

        return true;

    }
}