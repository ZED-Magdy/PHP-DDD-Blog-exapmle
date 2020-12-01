<?php

namespace App\Domain\Blog\Entity;

use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\CategoryName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Category
{
    private $id;
    private $name;
    private $posts;

    public function __construct(CategoryId $categoryId, CategoryName $categoryName)
    {
        $this->id = $categoryId;
        $this->name = $categoryName;
        $this->posts = new ArrayCollection();
    }

    public function getId(): CategoryId
    {
        return $this->id->id();
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
        }
        return $this;
    }
}
