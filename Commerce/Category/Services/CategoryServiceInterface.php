<?php

namespace Commerce\Category\Services;

use Commerce\Category\DTO\CategoryRequestDTO;

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