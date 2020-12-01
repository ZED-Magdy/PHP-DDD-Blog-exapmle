<?php

namespace App\Infrastructure\Blog\Persistence\Repositoy;

use App\Domain\Blog\Entity\Tag;
use App\Domain\Blog\Repository\TagRepositoryInterface;
use App\Domain\Blog\ValueObject\TagId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class TagRepository extends ServiceEntityRepository implements TagRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function nextIdentity(): TagId
    {
        return TagId::fromString(null);
    }

    public function fromId(TagId $tagId): Tag
    {
        return $this->findOneBy(['id' => $tagId->id()]);
    }

    public function listTags($options, int $page, int $limitPerPage)
    {
        $offset = (($page - 1) * $limitPerPage) + 1;
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->setFirstResult($offset)
            ->setMaxResults($limitPerPage);
        $paginator = new Paginator($query, false);
        return $paginator;
    }

    public function save(Tag $tag): void
    {
        $this->_em->persist($tag);
        $this->_em->flush();
    }
}
