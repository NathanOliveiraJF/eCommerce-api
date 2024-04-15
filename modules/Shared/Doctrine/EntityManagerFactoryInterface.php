<?php

namespace Modules\Shared\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Modules\Commerce\src\Category\Entity\Category;

interface EntityManagerFactoryInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}