<?php

namespace modules\Commerce\src\Category\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use modules\Commerce\src\Category\DTO\CategoryDTO;
use modules\Commerce\src\Category\Entity\Category;
use modules\Commerce\src\Category\Exceptions\CategoryException;
use modules\Shared\Doctrine\EntityManagerFactoryInterface;

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

    public function save(CategoryDTO $categoryDTO): void
    {
        $entityManager = $this->entityManagerFactory->getEntityManager();
        $entityManager->persist(new Category(0, $categoryDTO->code, $categoryDTO->name));
        $entityManager->flush();
    }

    public function findByCode(string $categoryCode): array
    {
        return $this->entityManagerFactory->getEntityManager()->getRepository(Category::class)->findBy(['code' => $categoryCode]);
    }
}