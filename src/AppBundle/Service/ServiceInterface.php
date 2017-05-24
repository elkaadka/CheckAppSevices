<?php

namespace AppBundle\Service;

/**
 * ServiceInterface
 *
 * The interface implemented by all the services
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
interface ServiceInterface
{
    /**
     * to check if the service is up
     * @return bool
     */
    public function isUp(): bool;
}