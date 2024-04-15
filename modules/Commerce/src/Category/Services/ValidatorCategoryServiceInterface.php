<?php

namespace Modules\Commerce\src\Category\Services;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;

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