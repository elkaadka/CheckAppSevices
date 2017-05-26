<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * class Mysql
 *
 * class that checks if mysql is up
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class Mysql implements ServiceInterface
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Checks if mysql is up
     * @return bool
     */
    public function isUp(): bool
    {
        try {
            $connection = $this->entityManager->getConnection();
            return $connection->ping();
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * return the name of the mysql service
     * @return string
     */
    public function getServiceName(): string
    {
        return 'MYSQL';
    }
}