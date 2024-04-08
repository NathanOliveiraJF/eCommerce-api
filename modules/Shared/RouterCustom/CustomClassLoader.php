<?php

namespace modules\Shared\RouterCustom;

use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use modules\Commerce\src\Category\Repositories\CategoryRepository;
use modules\Commerce\src\Category\Repositories\CategoryRepositoryInterface;
use modules\Commerce\src\Category\Services\CategoryService;
use modules\Commerce\src\Category\Services\CategoryServiceInterface;
use modules\Commerce\src\Category\Services\ValidatorCategoryService;
use modules\Commerce\src\Category\Services\ValidatorCategoryServiceInterface;
use modules\Commerce\src\Category\Validator\CheckIfCategoryAlreadyExist;
use modules\Commerce\src\Category\Validator\CheckIfCodeIsNotEmpty;
use modules\Commerce\src\Category\Validator\CheckIfNameIsNotEmpty;
use modules\Shared\Doctrine\EntityManagerFactory;
use modules\Shared\Doctrine\EntityManagerFactoryInterface;
use Pecee\SimpleRouter\ClassLoader\IClassLoader;
use Pecee\SimpleRouter\Exceptions\ClassNotFoundHttpException;
use function DI\autowire;

class CustomClassLoader implements IClassLoader
{
    protected \DI\Container $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container = (new ContainerBuilder())->addDefinitions([
            EntityManagerFactoryInterface::class => autowire(EntityManagerFactory::class),
            CategoryRepositoryInterface::class => autowire(CategoryRepository::class),
            CategoryServiceInterface::class => autowire(CategoryService::class),
            ValidatorCategoryServiceInterface::class => autowire(ValidatorCategoryService::class)->constructor([new CheckIfCodeIsNotEmpty(), new CheckIfNameIsNotEmpty()]),
        ])->build();
    }

    /**
     * Load class
     *
     * @param string $class
     * @return object
     * @throws ClassNotFoundHttpException
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function loadClass(string $class): object
    {
        if ($this->container->has($class) === false) {
            throw new ClassNotFoundHttpException($class, null, sprintf('Class "%s" does not exist', $class), 404, null);
        }
        return $this->container->get($class);
    }

    /**
     * Called when loading class method
     * @param object $class
     * @param string $method
     * @param array $parameters
     * @return string
     */
    public function loadClassMethod($class, string $method, array $parameters): string
    {
        return (string)$this->container->call([$class, $method], $parameters);
    }

    /**
     * Load closure
     *
     * @param Callable $closure
     * @param array $parameters
     * @return string
     */
    public function loadClosure(callable $closure, array $parameters): string
    {
        return (string)$this->container->call($closure, $parameters);
    }
}