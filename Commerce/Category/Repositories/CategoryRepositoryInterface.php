<?php

namespace Commerce\Category\Repositories;

use Commerce\Category\DTO\CategoryRequestDTO;

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