<?php

namespace Modules\Commerce\src\Category\Repositories;

use Modules\Commerce\src\Category\DTO\CategoryDTO;
use Modules\Commerce\src\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return void
     */
    public function save(CategoryDTO $categoryDTO): void;

    /**
     * @param string $categoryCode
     * @return array
     */
    public function findByCode(string $categoryCode): array;
}