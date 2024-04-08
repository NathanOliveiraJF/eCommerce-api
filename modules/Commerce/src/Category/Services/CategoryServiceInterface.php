<?php

namespace modules\Commerce\src\Category\Services;

use modules\Commerce\src\Category\DTO\CategoryDTO;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return void
     */
    public function save(CategoryDTO $categoryDTO): void;
}