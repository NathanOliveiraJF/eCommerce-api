<?php

namespace Commerce\Category\Http\Controllers;

use Commerce\Category\DTO\CategoryResponseDTO;
use Commerce\Category\Exceptions\CategoryException;
use Commerce\Category\Services\CategoryService;
use Commerce\Category\Services\CategoryServiceInterface;
use Commerce\Category\DTO\CategoryRequestDTO;

class CategoryController extends BaseController
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
            $category = $this->categoryService->save(CategoryRequestDTO::create(input()->all()));
            self::sendResponse('category successfully created','201', $category);
        } catch (CategoryException $categoryException) {
            self::sendError($categoryException->getMessage(), '400');
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function updateCategory($id): void
    {
        try {
            $this->categoryService->update(CategoryRequestDTO::create(input()->all()), $id);
            self::sendResponse('Category updated successfully!', '200');
        } catch (CategoryException $categoryException) {
            self::sendError($categoryException->getMessage(), '400');
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function getCategory($id): void
    {
        try {
            $category = $this->categoryService->findById($id);
            self::sendResponse('category successfully created', CategoryResponseDTO::create($category),'201');
        } catch (CategoryException $categoryException) {
            self::sendError($categoryException->getMessage(), '404');
        }
    }

    /**
     * @return void
     */
    public function getAllCategory(): void
    {
        $categories = $this->categoryService->findAll();
        self::sendResponse('', $categories,'200');
    }
}