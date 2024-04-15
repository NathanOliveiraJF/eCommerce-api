<?php

namespace Modules\Commerce\src\Category\Services;

use Modules\Commerce\src\Category\DTO\CategoryDTO;

interface ValidatorCategoryServiceInterface
{
    /**
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validated(CategoryDTO $categoryDTO): string;

    /**
     * @return string
     */
    public function getErrorMessages(): string;
}