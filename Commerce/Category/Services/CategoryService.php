<?php

namespace Commerce\Category\Services;

use Commerce\Category\DTO\CategoryResponseDTO;
use Commerce\Category\Entity\Category;
use Commerce\Category\Exceptions\CategoryException;
use Commerce\Category\Repositories\CategoryRepository;
use Commerce\Category\Repositories\CategoryRepositoryInterface;
use Commerce\Category\DTO\CategoryRequestDTO;
use Commerce\Logger\System\SystemLogger;
use Commerce\Logger\System\SystemLoggerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

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
     * @throws CategoryException
     */
    public function update(CategoryRequestDTO $categoryRequestDTO): void
    {
        $validationsData = $this->validatorCategoryServiceInterface->validated($categoryRequestDTO);
        if ($validationsData) {
            throw CategoryException::categoryIsNotValid($validationsData);
        }
    }

    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        $categories = $this->categoryRepository->findAll();
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

    /**
     * @param int $id
     * @return CategoryResponseDTO
     * @throws CategoryException
     */
    public function findById(int $id): CategoryResponseDTO
    {
        try {
            $categoryEntity = $this->categoryRepository->findById($id);
        } catch (OptimisticLockException|ORMException $e) {
            $this->systemLoggerInterface->execute($e->getMessage());
        }
        if (!isset($categoryEntity)) {
            throw CategoryException::categoryNotFound();
        }
        return CategoryResponseDTO::create($categoryEntity);
    }
}