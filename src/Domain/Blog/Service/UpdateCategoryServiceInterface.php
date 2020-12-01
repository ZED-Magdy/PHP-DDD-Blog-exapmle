<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Exception\CategoryNotFoundException;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\CategoryName;

interface UpdateCategoryServiceInterface
{
    /**
     *
     * @param CategoryId $categoryId
     * @param CategoryName $categoryName
     * @return boolean
     * @throws CategoryNotFoundException
     */
    public function execute(CategoryId $categoryId, CategoryName $categoryName): bool;
}
