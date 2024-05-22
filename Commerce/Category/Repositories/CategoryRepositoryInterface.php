<?php

namespace Commerce\Category\Repositories;

use Commerce\Category\DTO\CategoryRequestDTO;
use Commerce\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return Category
     */
    public function save(CategoryRequestDTO $categoryDTO): Category;

    public function update(CategoryRequestDTO $categoryRequestDTO, int $id): void;

    /**
     * @param string $categoryCode
     * @return Category
     */
    public function findByCode(string $categoryCode): Category;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Category
     */
    public function findById(int $id): Category|null;
}