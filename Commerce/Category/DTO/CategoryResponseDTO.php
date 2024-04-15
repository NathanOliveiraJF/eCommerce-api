<?php

namespace Commerce\Category\DTO;

use Commerce\Category\Entity\Category;

class CategoryResponseDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public int $created_at,
        public int $updated_at,
    ) {
    }

    public static function create(Category $category): CategoryResponseDTO
    {
        return new self($category->getId(), $category->getCode(), $category->getName(), $category->getCreatedAt()->getTimestamp(), $category->getUpdatedAt()->getTimestamp());
    }
}