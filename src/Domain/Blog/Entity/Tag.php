<?php

namespace App\Domain\Blog\Entity;

use App\Domain\Blog\ValueObject\TagId;
use App\Domain\Blog\ValueObject\TagName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{
    private $id;
    private $name;
    private $posts;

    public function __construct(TagId $tagId, TagName $tagName)
    {
        $this->id = $tagId;
        $this->name = $tagName;
        $this->posts = new ArrayCollection();
    }

    public function getId(): TagId
    {
        return $this->id;
    }

    public function getName(): TagName
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
