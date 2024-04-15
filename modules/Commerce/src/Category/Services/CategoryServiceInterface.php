<?php

namespace Modules\Commerce\src\Category\Services;

use Modules\Commerce\src\Category\DTO\CategoryDTO;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return void
     */
    public function save(CategoryDTO $categoryDTO): void;

    /**
     * @return array
     */
    public function findAll(): array;
}