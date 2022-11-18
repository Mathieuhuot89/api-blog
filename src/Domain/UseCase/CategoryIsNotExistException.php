<?php 

namespace App\Domain\UseCase;

use LogicException;

class CategoryIsNotExistException extends LogicException
{
    public const CODE_CATEGORY_NOT_FOUND = 1;

    public static function fromId(int $id): self
    {
        return new self("Category is not found with id $id", self::CODE_CATEGORY_NOT_FOUND);
    }

}