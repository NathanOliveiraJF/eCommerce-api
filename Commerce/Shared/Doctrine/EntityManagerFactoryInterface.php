<?php

namespace Commerce\Shared\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

interface EntityManagerFactoryInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}