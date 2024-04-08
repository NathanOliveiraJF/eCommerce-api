<?php

namespace modules\Shared\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use modules\Commerce\src\Category\Entity\Category;

interface EntityManagerFactoryInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}