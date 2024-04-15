<?php

namespace Modules\Commerce\src\Category\Repositories;

use Modules\Commerce\src\Category\DTO\CategoryRequestDTO;
use Modules\Commerce\src\Category\Entity\Category;
use Modules\Shared\Doctrine\EntityManagerFactoryInterface;

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

    public function save(CategoryRequestDTO $categoryDTO): void
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();
        $entityManager->persist(new Category(0, $categoryDTO->code, $categoryDTO->name));
        $entityManager->flush();
    }

    public function findByCode(string $categoryCode): array
    {
        return $this->entityManagerFactory->getEntityManager()->getRepository(Category::class)->findBy(['code' => $categoryCode]);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->entityManagerFactory->getEntityManager()->getRepository(Category::class)->findAll();
    }
}