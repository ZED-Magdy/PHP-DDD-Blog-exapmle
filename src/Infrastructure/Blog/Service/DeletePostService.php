<?php
namespace App\Infrastructure\Blog\Service;

use App\Domain\Blog\Exception\PostNotFoundException;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\Service\DeletePostServiceInterface;
use App\Domain\Blog\ValueObject\PostId;

class DeletePostService implements DeletePostServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;    
    }

    public function execute(PostId $postId): void
    {
        $post = $this->postRepository->fromId($postId);
        if(!$post) {
            throw new PostNotFoundException(`Post of id {$postId->id()} was not found.`);
        }
        $this->postRepository->remove($post); 
    }
}