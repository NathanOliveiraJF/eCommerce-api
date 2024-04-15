<?php

namespace Modules\Commerce\src\Category\Validator;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;

class CheckIfNameIsNotEmpty implements ValidatorInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryRequestDTO $categoryDTO): string
    {
        if (!$categoryDTO->name) {
            return "The name cannot be empty";
        }
        return "";
    }
}