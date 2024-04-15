<?php

namespace Commerce\Category\Http\Controllers;

use Commerce\Category\Exceptions\CategoryException;
use Commerce\Category\Services\CategoryService;
use Commerce\Category\Services\CategoryServiceInterface;
use Commerce\Category\DTO\CategoryRequestDTO;

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
            $this->categoryService->save(CategoryRequestDTO::create(input()->all()));
            response()->httpCode(201)->json(array('statusCode' => '201', 'message' => 'category successfully created'));
        } catch (CategoryException $categoryException) {
            response()->httpCode(400)->json(array('statusCode' => '400', 'message' => $categoryException->getMessage()));
        }
    }

    public function updateCategory(): void
    {

    }

    /**
     * @param $id
     * @return void
     */
    public function getCategory($id): void
    {
        try {
            $category = $this->categoryService->findById($id);
            response()->httpCode(200)->json(array('statusCode' => '200', 'category' => $category));
        } catch (CategoryException $categoryException) {
            response()->httpCode(404)->json(array('statusCode' => '404', 'message' => $categoryException->getMessage()));
        }
    }

    /**
     * @return void
     */
    public function getAllCategory(): void
    {
        $categories = $this->categoryService->findAll();
        response()->httpCode(200)->json(array('statusCode' => '200', 'categories' => $categories));
    }
}