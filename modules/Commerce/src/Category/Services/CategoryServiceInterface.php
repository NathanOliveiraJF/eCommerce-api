<?php

namespace Modules\Commerce\src\Category\Services;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;

interface CategoryServiceInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return void
     */
    public function save(CategoryRequestDTO $categoryDTO): void;

    /**
     * @return array
     */
    public function findAll(): array;
}