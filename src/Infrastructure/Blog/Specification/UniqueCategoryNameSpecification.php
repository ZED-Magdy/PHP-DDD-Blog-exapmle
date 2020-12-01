<?php
namespace App\Infrastructure\Blog\Specification;

use App\Domain\Blog\Specification\UniqueCategoryNameSpecificationInterface;
use App\Domain\Blog\ValueObject\CategoryName;

class UniqueCategoryNameSpecification implements UniqueCategoryNameSpecificationInterface
{
    
    public function isUnique(CategoryName $categoryName): bool
    {
        return true;
    }
}