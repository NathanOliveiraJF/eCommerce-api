<?php

namespace Commerce\Shared\DI;

use Commerce\Category\Repositories\CategoryRepository;
use Commerce\Category\Repositories\CategoryRepositoryInterface;
use Commerce\Category\Services\CategoryService;
use Commerce\Category\Services\CategoryServiceInterface;
use Commerce\Category\Services\ValidatorCategoryService;
use Commerce\Category\Services\ValidatorCategoryServiceInterface;
use Commerce\Category\Validator\CheckIfCodeIsNotEmpty;
use Commerce\Category\Validator\CheckIfNameIsNotEmpty;
use Commerce\Logger\System\SystemLogger;
use Commerce\Logger\System\SystemLoggerInterface;
use Commerce\Shared\Doctrine\EntityManagerFactory;
use Commerce\Shared\Doctrine\EntityManagerFactoryInterface;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Monolog\Logger;
use Pecee\SimpleRouter\ClassLoader\IClassLoader;
use Pecee\SimpleRouter\Exceptions\ClassNotFoundHttpException;
use function DI\autowire;

class ClassLoader implements IClassLoader
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
            SystemLoggerInterface::class => autowire(SystemLogger::class)->constructor(new Logger('system'))

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
        return (string) $this->container->call([$class, $method], $parameters);
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
        return (string) $this->container->call($closure, $parameters);
    }
}