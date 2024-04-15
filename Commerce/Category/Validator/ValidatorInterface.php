<?php

namespace Commerce\Category\Validator;

use Commerce\Category\DTO\CategoryRequestDTO;

interface ValidatorInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryRequestDTO $categoryDTO): string;
}