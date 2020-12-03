<?php


namespace App\Infrastructure\Blog\Service;


use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Exception\CategoryNameAlreadyExistsException;
use App\Domain\Blog\Repository\CategoryRepositoryInterface;
use App\Domain\Blog\Service\CreateCategoryServiceInterface;
use App\Domain\Blog\ValueObject\CategoryName;

class CreateCategoryService implements CreateCategoryServiceInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryName $categoryName
     * @return Category
     * @throws CategoryNameAlreadyExistsException
     */
    public function execute(CategoryName $categoryName): Category
    {
        $category = $this->categoryRepository->fromName($categoryName);

        if ($category) {
            throw new CategoryNameAlreadyExistsException("Category of name {$categoryName->name()} already exists");
        }

        $category = new Category(
            $this->categoryRepository->nextIdentity(),
            $categoryName
        );
        $this->categoryRepository->save($category);
        return $category;
    }
}