<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Exception\CategoryNameAlreadyExistsException;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\CategoryName;

interface CreateCategoryServiceInterface
{
    /**
     *
     * @param CategoryId $categoryId
     * @param CategoryName $categoryName
     * @return Category
     * @throws CategoryNameAlreadyExistsException
     */
    public function execute(CategoryId $categoryId, CategoryName $categoryName): Category;
}
