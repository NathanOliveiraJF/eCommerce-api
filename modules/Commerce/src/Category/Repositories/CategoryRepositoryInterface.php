<?php

namespace Modules\Commerce\src\Category\Repositories;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;
use Modules\Commerce\src\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return void
     */
    public function save(CategoryRequestDTO $categoryDTO): void;

    /**
     * @param string $categoryCode
     * @return array
     */
    public function findByCode(string $categoryCode): array;
}