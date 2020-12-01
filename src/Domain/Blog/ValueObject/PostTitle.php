<?php

namespace App\Domain\Blog\ValueObject;

use Assert\Assertion;

class PostTitle
{
    private $title;

    public function __construct($aPostTitle)
    {
        Assertion::notEmpty($aPostTitle, 'Post title cannot be empty');
        Assertion::minLength($aPostTitle, 5, 'Title should have more than 5 letters');
        
        $this->title = $aPostTitle;
    }

    public function title()
    {
        return $this->title;
    }
    
}
