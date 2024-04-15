<?php

namespace Modules\Commerce\src\Category\Validator;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;

class CheckIfCodeIsNotEmpty implements ValidatorInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryRequestDTO $categoryDTO): string
    {
        if (!$categoryDTO->code) {
            return "The code cannot be empty";
        }
        return "";
    }
}