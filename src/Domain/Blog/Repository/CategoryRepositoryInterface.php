<?php

namespace App\Domain\Blog\Repository;

use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\CategoryName;

interface CategoryRepositoryInterface
{
    public function nextIdentity(): CategoryId;
    public function fromId(CategoryId $categoryId): Category;
    public function fromName(CategoryName $categoryName): Category;
    public function listCategories($options, int $page, int $limitPerPage);
    public function save(Category $category): void;
}
