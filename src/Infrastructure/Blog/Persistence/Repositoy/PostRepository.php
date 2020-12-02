<?php

namespace App\Infrastructure\Blog\Persistence\Repositoy;

use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\Repository\PostRepositoryInterface;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function nextIdentity(): PostId
    {
        return PostId::fromString(null);
    }

    public function fromId(PostId $postId): ?Post
    {
        return $this->findOneBy(['id' => $postId->id()]);
    }

    public function fromSlug(PostSlug $postSlug): ?Post
    {
        return $this->findOneBy(['slug' => $postSlug->slug()]);
    }

    public function fromTitle(PostTitle $postTitle): ?Post
    {
        return $this->findOneBy(['title' => $postTitle->title()]);
    }

    public function listPosts($options, int $page, int $limitPerPage): Paginator
    {
        $offset = (($page - 1) * $limitPerPage) + 1;
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->setFirstResult($offset)
            ->setMaxResults($limitPerPage);
        $paginator = new Paginator($query);
        return $paginator;
    }


    public function isAvailable(PostSlug $postSlug, PostTitle $postTitle, PostId $postId): bool
    {
        $qb = $this->createQueryBuilder('p');

        $posts = $qb->select('p')
            ->where($qb->expr()->neq('p.id', $postId->id()))
            ->andWhere('p.slug = :slug')
            ->orWhere('p.title = :title')
            ->setParameter('slug', $postSlug->slug())
            ->setParameter('title', $postTitle->title())
            ->getQuery()
            ->getResult();
        if ($posts) {
            return false;
        }
        return true;
    }

    public function save(Post $post): void
    {
        $this->_em->persist($post);
        $this->_em->flush();
    }
    
    public function remove(Post $post): void
    {
        $this->_em->remove($post);
        $this->_em->flush();
    }
}
