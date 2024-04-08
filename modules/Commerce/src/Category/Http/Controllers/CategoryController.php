<?php

namespace modules\Commerce\src\Category\Http\Controllers;

use modules\Commerce\src\Category\DTO\CategoryDTO;
use modules\Commerce\src\Category\Exceptions\CategoryException;
use modules\Commerce\src\Category\Repositories\CategoryRepositoryInterface;
use modules\Commerce\src\Category\Services\CategoryService;
use modules\Commerce\src\Category\Services\CategoryServiceInterface;
use parallel\Events\Input;

class CategoryController
{
    /**
     * @var CategoryService
     */
    private CategoryServiceInterface $categoryService;

    /**
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return void
     */
    public function postCategory(): void
    {
        try {
            $this->categoryService->save(CategoryDTO::create(input()->all()));
            response()->httpCode(201)->json(array('statusCode' => '201', 'message' => 'category successfully created'));
        } catch (CategoryException $categoryException) {
            response()->httpCode(400)->json(array('statusCode' => '400', 'message' => $categoryException->getMessage()));
        }
    }
}