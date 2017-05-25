<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * class AbstractService
 *
 * The abstract extended by all the services
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
abstract class AbstractService implements ServiceInterface
{
    const SERVICE_NAME = 'UNKNOWN_SERVICE';

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}