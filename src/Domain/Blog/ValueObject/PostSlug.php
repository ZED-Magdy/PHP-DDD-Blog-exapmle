<?php

namespace App\Domain\Blog\ValueObject;

use Assert\InvalidArgumentException;

class PostSlug
{
    private $slug;

    public function __construct($aPostSlug)
    {
        $this->assertSlug($aPostSlug);

        $this->slug = $aPostSlug;
    }

    public function slug()
    {
        return $this->slug;
    }

    private function assertSlug($aPostSlug) {
        if(!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $aPostSlug)){
            throw new InvalidArgumentException('Invalid Slug', 231);
        }
        return true;
    }
}
