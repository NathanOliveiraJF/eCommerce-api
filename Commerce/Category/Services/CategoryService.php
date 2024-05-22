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
use Monolog\Level;

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
    private SystemLoggerInterface $logger;

    /**
     * @param ValidatorCategoryServiceInterface $validator
     * @param CategoryRepositoryInterface $categoryRepository
     * @param SystemLoggerInterface $systemLoggerInterface
     */
    public function __construct(ValidatorCategoryServiceInterface $validator, CategoryRepositoryInterface $categoryRepository, SystemLoggerInterface $systemLoggerInterface)
    {
        $this->categoryRepository = $categoryRepository;
        $this->validatorCategoryServiceInterface = $validator;
        $this->logger = $systemLoggerInterface;
    }

    /**
     * @throws CategoryException
     */
    public function save(CategoryRequestDTO $categoryDTO): Category
    {
        $validationsData = $this->validatorCategoryServiceInterface->validated($categoryDTO);
        if ($validationsData) {
            throw CategoryException::categoryIsNotValid($validationsData);
        }
        $this->checkIfCategoryAlreadyExist($categoryDTO);
        return $this->categoryRepository->save($categoryDTO);
    }

    /**
     * @throws CategoryException
     */
    public function update(CategoryRequestDTO $categoryRequestDTO, int $id): void
    {
        
        $validationsData = $this->validatorCategoryServiceInterface->validated($categoryRequestDTO);
        if ($validationsData) {
            throw CategoryException::categoryIsNotValid($validationsData);
        }
        $this->findById($id);
        $this->categoryRepository->update($categoryRequestDTO, $id);
    }

    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        $categories = $this->categoryRepository->findAll();
        if (!isset($categories)) {
            $this->logger->warning('Does not exist categories');
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
        if (!$alreadyExist->getId()) {
            $this->logger->warning('Category code already exist!');
            throw CategoryException::alreadyExistCodeCategory($categoryDTO->code);
        }
    }

    /**
     * @param int $id
     * @return Category
     * @throws CategoryException
     */
    public function findById(int $id): Category
    {
        try {
            $categoryEntity = $this->categoryRepository->findById($id);
        } catch (OptimisticLockException|ORMException $exception) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }
        if (!isset($categoryEntity)) {
            throw CategoryException::categoryNotFound($id);
        }
        return $categoryEntity;
    }
}