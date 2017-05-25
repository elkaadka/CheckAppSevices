<?php

namespace AppBundle\Service;

/**
 * class Mysql
 *
 * class that checks if mysql is up
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class Mysql extends AbstractService
{
    const SERVICE_NAME = 'MYSQL';

    /**
     * Checks if mysql is up
     * @return bool
     */
    public function isUp(): bool
    {
        try {
            $doctrine = $this->container->get('doctrine');
            $connection = $doctrine->getConnection();
            return $connection->ping();
        } catch (\Exception $exception) {
            return false;
        }

        return false;
    }
}