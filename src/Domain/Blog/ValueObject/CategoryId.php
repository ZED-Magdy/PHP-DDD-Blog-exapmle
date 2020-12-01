<?php

namespace App\Domain\Blog\ValueObject;

use Ramsey\Uuid\Uuid;

class CategoryId
{
    private $id;

    private function __construct($aCategoryId = null)
    {
        $this->id = $aCategoryId ?? Uuid::uuid4()->toString();
    }
    public static function fromString($aCategoryId = null)
    {
        return new static($aCategoryId);
    }

    public function id()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->id();
    }
}
