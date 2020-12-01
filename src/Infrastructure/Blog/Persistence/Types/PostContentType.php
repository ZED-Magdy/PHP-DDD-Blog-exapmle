<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\PostContent;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class PostContentType extends TextType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new PostContent($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof PostContent) {
            return $value->content();
        }
        return $value;
    }

    public function getName()
    {
        return 'PostContent';
    }
}
