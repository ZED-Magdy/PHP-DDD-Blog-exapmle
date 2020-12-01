<?php

namespace App\Domain\Blog\ValueObject;

class TagName
{
    private $name;

    public function __construct($aTagName)
    {
        //TODO: validate
        $this->name = $aTagName;
    }

    public function name()
    {
        return $this->name;
    }
}
