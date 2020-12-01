<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\PostSlug;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PostSlugType extends StringType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new PostSlug($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof PostSlug) {
            return $value->slug();
        }
        return $value;
    }

    public function getName()
    {
        return 'PostSlug';
    }
}
