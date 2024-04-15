<?php

namespace Commerce\Category\Validator;

use Commerce\Category\DTO\CategoryRequestDTO;

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