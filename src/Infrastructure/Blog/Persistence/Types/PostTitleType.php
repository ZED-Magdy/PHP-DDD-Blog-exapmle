<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\PostTitle;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PostTitleType extends StringType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new PostTitle($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof PostTitle) {
            return $value->title();
        }
        return $value;
    }

    public function getName()
    {
        return 'PostTitle';
    }
}
