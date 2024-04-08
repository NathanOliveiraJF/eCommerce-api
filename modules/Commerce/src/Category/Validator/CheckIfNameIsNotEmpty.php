<?php

namespace modules\Commerce\src\Category\Validator;

use modules\Commerce\src\Category\DTO\CategoryDTO;

class CheckIfNameIsNotEmpty implements ValidatorInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryDTO $categoryDTO): string
    {
        if (!$categoryDTO->name) {
            return "The name cannot be empty";
        }
        return "";
    }
}