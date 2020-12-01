<?php

namespace App\Infrastructure\Blog\Persistence\Types;

use App\Domain\Blog\ValueObject\CategoryName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class CategoryNameType extends StringType
{

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new CategoryName($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof CategoryName) {
            return $value->name();
        }
        return $value;
    }

    public function getName()
    {
        return 'CategoryName';
    }
}
