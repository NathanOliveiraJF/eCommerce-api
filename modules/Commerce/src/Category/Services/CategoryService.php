<?php

namespace modules\Commerce\src\Category\Services;

use modules\Commerce\src\Category\DTO\CategoryDTO;
use modules\Commerce\src\Category\Entity\Category;
use modules\Commerce\src\Category\Exceptions\CategoryException;
use modules\Commerce\src\Category\Repositories\CategoryRepository;
use modules\Commerce\src\Category\Repositories\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @var ValidatorCategoryService
     */
    private ValidatorCategoryServiceInterface $validatorCategoryServiceInterface;

    /**
     * @var CategoryRepository
     */
    private CategoryRepositoryInterface $categoryRepository;

    /**
     * @param ValidatorCategoryServiceInterface $validator
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(ValidatorCategoryServiceInterface $validator, CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->validatorCategoryServiceInterface = $validator;
    }

    /**
     * @throws CategoryException
     */
    public function save(CategoryDTO $categoryDTO): void
    {
        $validationsData = $this->validatorCategoryServiceInterface->validated($categoryDTO);
        if ($validationsData) {
            throw CategoryException::categoryIsNotValid($validationsData);
        }
        $this->checkIfCategoryAlreadyExist($categoryDTO);
        $this->categoryRepository->save($categoryDTO);
    }

    /**
     * @throws CategoryException
     */
    private function checkIfCategoryAlreadyExist(CategoryDTO $categoryDTO): void
    {
        $alreadyExist = $this->categoryRepository->findByCode($categoryDTO->code);
        if ($alreadyExist) {
            throw CategoryException::alreadyExistCodeCategory($categoryDTO->code);
        }
    }
}