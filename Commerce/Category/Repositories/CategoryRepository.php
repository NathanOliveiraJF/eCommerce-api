<?php

namespace Commerce\Category\Repositories;

use Commerce\Category\Entity\Category;
use Commerce\Category\DTO\CategoryRequestDTO;
use Commerce\Shared\Doctrine\EntityManagerFactoryInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class CategoryRepository implements CategoryRepositoryInterface
{
    private EntityManagerFactoryInterface $entityManagerFactory;

    /**
     * @param EntityManagerFactoryInterface $entityManagerFactory
     */
    public function __construct(EntityManagerFactoryInterface $entityManagerFactory)
    {
        $this->entityManagerFactory = $entityManagerFactory;
    }

    public function save(CategoryRequestDTO $categoryDTO): Category
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();
        $entityManager->persist(new Category(0, $categoryDTO->code, $categoryDTO->name));
        $entityManager->flush();
        $entityManager->close();
        return $this->findByCode($categoryDTO->code);
    }

    public function findByCode(string $categoryCode): Category
    {
        return $this->entityManagerFactory->getEntityManager()->getRepository(Category::class)->findOneBy(['code' => $categoryCode]);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->entityManagerFactory->getEntityManager()->getRepository(Category::class)->findAll();
    }

    /**
     * @param int $id
     * @return Category|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function findById(int $id): Category|null
    {
        return $this->entityManagerFactory->getEntityManager()->find(Category::class, $id);
    }

    /**
     * @param CategoryRequestDTO $categoryRequestDTO
     * @param int $id
     */
    public function update(CategoryRequestDTO $categoryRequestDTO, int $id): void
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();
        $category = $entityManager->getRepository(category::class)->find($id);
        $category->populateFromDTO($categoryRequestDTO);
        $entityManager->flush();
    }
}