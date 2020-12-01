<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Exception\CategoryNotFoundException;
use App\Domain\Blog\ValueObject\CategoryId;

interface DeleteCategoryServiceInterface
{
    /**
     * Undocumented function
     *
     * @param CategoryId $categoryId
     * @return void
     * @throws CategoryNotFoundException
     */
    public function execute(CategoryId $categoryId): void;
}
