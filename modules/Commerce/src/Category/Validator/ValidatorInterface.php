<?php

namespace modules\Commerce\src\Category\Validator;

use modules\Commerce\src\Category\DTO\CategoryDTO;

interface ValidatorInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryDTO $categoryDTO): string;
}