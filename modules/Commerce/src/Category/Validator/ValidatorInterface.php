<?php

namespace Modules\Commerce\src\Category\Validator;

use Modules\Commerce\src\Category\DTO\CategoryDTO;

interface ValidatorInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validator(CategoryDTO $categoryDTO): string;
}