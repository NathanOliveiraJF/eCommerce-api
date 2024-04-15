<?php

namespace Modules\Commerce\src\Category\Exceptions;

class CategoryException extends \Exception
{
    /**
     * @param string $code
     * @return self
     */
    public static function alreadyExistCodeCategory(string $code): self
    {
        return new self("A category with this code $code already exists!");
    }

    /**
     * @param string $validations
     * @return self
     */
    public static function categoryIsNotValid(string $validations): self
    {
        return new self($validations);
    }
}