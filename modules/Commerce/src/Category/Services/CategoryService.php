<?php

namespace Modules\Commerce\src\Category\Services;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;
use Modules\Commerce\src\Category\DTO\CategoryResponseDTO;
use Modules\Commerce\src\Category\Entity\Category;
use Modules\Commerce\src\Category\Exceptions\CategoryException;
use Modules\Commerce\src\Category\Repositories\CategoryRepository;
use Modules\Commerce\src\Category\Repositories\CategoryRepositoryInterface;
use Modules\Logger\System\SystemLogger;
use Modules\Logger\System\SystemLoggerInterface;

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
     * @var SystemLogger
     */
    private SystemLoggerInterface $systemLoggerInterface;

    /**
     * @param ValidatorCategoryServiceInterface $validator
     * @param CategoryRepositoryInterface $categoryRepository
     * @param SystemLoggerInterface $systemLoggerInterface
     */
    public function __construct(ValidatorCategoryServiceInterface $validator, CategoryRepositoryInterface $categoryRepository, SystemLoggerInterface $systemLoggerInterface)
    {
        $this->categoryRepository = $categoryRepository;
        $this->validatorCategoryServiceInterface = $validator;
        $this->systemLoggerInterface = $systemLoggerInterface;
    }

    /**
    * @throws CategoryException
     */
    public function save(CategoryRequestDTO $categoryDTO): void
    {
        $validationsData = $this->validatorCategoryServiceInterface->validated($categoryDTO);
        if ($validationsData) {
            throw CategoryException::categoryIsNotValid($validationsData);
        }
        $this->checkIfCategoryAlreadyExist($categoryDTO);
        $this->categoryRepository->save($categoryDTO);
        $this->systemLoggerInterface->execute('[category] Category successfully created');
    }

    /**
     * @return Category[]
     */
    public function findAll(): array
    {
         $categories =  $this->categoryRepository->findAll();
         if (!isset($categories)) {
             $this->systemLoggerInterface->execute('[category] Does not exist categories');
             return [];
         }
         return array_map(function (Category $category) {
             return $this->convertCategoryInCategoryResponseDTO($category);
         }, $categories);
    }

    /**
     * @param Category $category
     * @return CategoryResponseDTO
     */
    private function convertCategoryInCategoryResponseDTO(Category $category): CategoryResponseDTO
    {
        return CategoryResponseDTO::create($category);
    }

    /**
     * @throws CategoryException
     */
    private function checkIfCategoryAlreadyExist(CategoryRequestDTO $categoryDTO): void
    {
        $alreadyExist = $this->categoryRepository->findByCode($categoryDTO->code);
        if ($alreadyExist) {
            $this->systemLoggerInterface->execute('[category] Category code already exist!');
            throw CategoryException::alreadyExistCodeCategory($categoryDTO->code);
        }
    }
}