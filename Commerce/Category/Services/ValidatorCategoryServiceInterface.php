<?php

namespace Commerce\Category\Services;

use Commerce\Category\DTO\CategoryRequestDTO;

interface ValidatorCategoryServiceInterface
{
    /**
     * @param CategoryRequestDTO $categoryDTO
     * @return string
     */
    public function validated(CategoryRequestDTO $categoryDTO): string;

    /**
     * @return string
     */
    public function getErrorMessages(): string;
}