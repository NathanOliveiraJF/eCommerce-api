<?php

namespace Modules\Commerce\src\Category\Validator;

use Modules\Commerce\src\Category\DTO\CategoryDTO;

class CheckIfCodeIsNotEmpty implements ValidatorInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryDTO $categoryDTO): string
    {
        if (!$categoryDTO->code) {
            return "The code cannot be empty";
        }
        return "";
    }
}