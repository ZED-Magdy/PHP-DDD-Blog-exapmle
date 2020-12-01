<?php
namespace App\Domain\Blog\Repository;

use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\Exception\PostNotFoundException;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface PostRepositoryInterface
{
    public function nextIdentity(): PostId;
    /**
     *
     * @param PostId $postId
     * @return Post
     * @throws PostNotFoundException
     */
    public function fromId(PostId $postId): ?Post;
    public function fromSlug(PostSlug $postSlug): ?Post;
    public function fromTitle(PostTitle $postTitle): ?Post;
    public function listPosts($options, int $page, int $limitPerPage): Paginator;
    public function save(Post $post): void;
}