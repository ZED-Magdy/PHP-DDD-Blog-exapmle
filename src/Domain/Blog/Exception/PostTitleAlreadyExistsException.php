<?php

namespace App\Domain\Blog\Exception;

class PostTitleAlreadyExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Post title is already in use');
    }
}
