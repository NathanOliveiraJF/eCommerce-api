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
     * @return CategoryResponseDTO
     */
    public function findById(int $id): CategoryResponseDTO;

    /**
     * @param CategoryRequestDTO $categoryRequestDTO
     * @return void
     */
    public function update(CategoryRequestDTO $categoryRequestDTO): void;
}