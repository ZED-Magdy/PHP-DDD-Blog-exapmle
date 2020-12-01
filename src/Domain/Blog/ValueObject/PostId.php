<?php

namespace App\Domain\Blog\ValueObject;

use Ramsey\Uuid\Uuid;

class PostId
{
    private $id;

    private function __construct($aPostId = null)
    {
        $this->id = $aPostId ?? Uuid::uuid4()->toString();
    }
    public static function fromString($aPostId = null)
    {
        return new static($aPostId);
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
