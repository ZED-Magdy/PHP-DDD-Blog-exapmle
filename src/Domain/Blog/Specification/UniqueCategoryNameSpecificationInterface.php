<?php
namespace App\Domain\Blog\Specification;

use App\Domain\Blog\ValueObject\CategoryName;

interface UniqueCategoryNameSpecificationInterface
{
    public function isUnique(CategoryName $categoryName): bool;
}