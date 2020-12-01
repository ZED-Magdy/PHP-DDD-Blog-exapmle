<?php

namespace App\Domain\Blog\ValueObject;

use Assert\Assertion;

class PostContent
{
    private $content;

    public function __construct($aPostContent)
    {
        Assertion::notEmpty($aPostContent, 'Post content should not be empty');
        Assertion::minLength($aPostContent, 30, 'Post Content should not be less than 30 characters');
        $this->content = $aPostContent;
    }

    public function content()
    {
        return $this->content;
    }
}
