<?php

namespace App\Domain\Blog\Entity;

use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Post
{
    private $id;
    private $title;
    private $content;
    private $slug;
    private $category;
    private $tags;

    private function __construct(PostId $postId, PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, Category $category = null)
    {
        $this->id      = $postId;
        $this->slug    = $postSlug;
        $this->title   = $postTitle;
        $this->content = $postContent;
        $this->category = $category;
        $this->tags = new ArrayCollection();
    }


    public static function create(PostId $postId, PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, Category $category = null): self
    {
        return new self($postId, $postSlug, $postTitle, $postContent, $category);
    }


    public function update(PostSlug $postSlug, PostTitle $postTitle, PostContent $postContent, Category $category = null, array $tags = null): self
    {
        $this->slug = $postSlug;
        $this->title = $postTitle;
        $this->content = $postContent;
        if ($category) {
            $this->category = $category;
        }
        if ($tags) {
            $this->tags = $tags;
        }
        return $this;
    }
    public function getId(): PostId
    {
        return $this->id;
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function getSlug(): PostSlug
    {
        return $this->slug;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     *
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
