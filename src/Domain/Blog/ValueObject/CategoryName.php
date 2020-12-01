<?php

namespace App\Domain\Blog\ValueObject;

class CategoryName
{
    private $name;

    public function __construct($aCategoryName)
    {
        //TODO: validate
        $this->name = $aCategoryName;
    }

    public function name()
    {
        return $this->name;
    }
}
