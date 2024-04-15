<?php

namespace Modules\Commerce\src\Category\DTO;

use Modules\Commerce\src\Category\Entity\Category;

readonly class CategoryDTO
{
    /**
     * @param string $code
     * @param string $name
     */
    private function __construct(
        public string $code,
        public string $name
    )
    {
    }

    /**
     * @param array $category
     * @return self
     */
    public static function create(array $category): self
    {
        return new self($category['code'], $category['name']);
    }
}