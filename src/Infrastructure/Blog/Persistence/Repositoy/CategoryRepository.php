<?php

namespace App\Infrastructure\Blog\Persistence\Repositoy;

use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Repository\CategoryRepositoryInterface;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\CategoryName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function nextIdentity(): CategoryId
    {
        return CategoryId::fromString(null);
    }

    public function fromId(CategoryId $categoryId): Category
    {
        return $this->findOneBy(['id' => $categoryId->id()]);
    }

    public function listCategories($options, int $page, int $limitPerPage)
    {
        $offset = (($page - 1) * $limitPerPage) + 1;
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->setFirstResult($offset)
            ->setMaxResults($limitPerPage);
        $paginator = new Paginator($query, false);
        return $paginator;
    }

    public function save(Category $category): void
    {
        $this->_em->persist($category);
        $this->_em->flush();
    }

    public function fromName(CategoryName $categoryName): Category
    {
        return $this->findOneBy(['name' => $categoryName->name()]);
    }
}
