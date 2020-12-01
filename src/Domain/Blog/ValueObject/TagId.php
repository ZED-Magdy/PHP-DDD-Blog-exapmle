<?php

namespace App\Domain\Blog\ValueObject;

use Ramsey\Uuid\Uuid;

class TagId
{
    private $id;

    private function __construct($aTagId = null)
    {
        $this->id = $aTagId ?? Uuid::uuid4()->toString();
    }
    public static function fromString($aTagId = null)
    {
        return new static($aTagId);
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
