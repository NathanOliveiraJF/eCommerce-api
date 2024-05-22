<?php

namespace Commerce\Category\Services;

use Commerce\Category\DTO\CategoryRequestDTO;
use Commerce\Category\DTO\CategoryResponseDTO;
use Commerce\Category\Entity\Category;

interface CategoryServiceInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return Category
     */
    public function save(CategoryRequestDTO $categoryDTO): Category;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Category
     */
    public function findById(int $id): Category;

    /**
     * @param CategoryRequestDTO $categoryRequestDTO
     * @return void
     */
    public function update(CategoryRequestDTO $categoryRequestDTO, int $id): void;
}