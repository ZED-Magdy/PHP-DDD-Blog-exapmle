<?php

namespace App\Domain\Blog\Exception;

class PostSlugAlreadyExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Post slug is already in use');
    }
}
