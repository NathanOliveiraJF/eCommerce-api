<?php

namespace Commerce\Category\Repositories;

use Commerce\Category\DTO\CategoryRequestDTO;
use Commerce\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return void
     */
    public function save(CategoryRequestDTO $categoryDTO): void;

    /**
     * @param CategoryRequestDTO $categoryRequestDTO
     * @param int $id
     * @return void
     */
    public function update(CategoryRequestDTO $categoryRequestDTO, int $id): void;

    /**
     * @param string $categoryCode
     * @return array
     */
    public function findByCode(string $categoryCode): array;

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