<?php

namespace AppBundle\Service;

use AppBundle\Service\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * class ServiceFactory
 *
 * factory class that creates services
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class ServiceFactory
{
    const SERVICES = [Mysql::class, Redis::class];

    /**
     * Create a service
     * @param string $class the service to create
     * @param ContainerInterface $container the construct parameter of the services
     * @return ServiceInterface
     * @throws ServiceNotFoundException
     */
    public function create(string $class, ContainerInterface $container): ServiceInterface
    {
        //if class is known and belong to the same namepsace as the factory
        if (class_exists($class) && strpos($class, __NAMESPACE__) === 0) {
            return new $class($container);
        }

        throw new ServiceNotFoundException('Service ' . $class . ' not found');
    }

    /**
     * Yields a list of all the services available
     * @param ContainerInterface $container the construct parameter of the services classes
     * @return \Generator
     */
    public function getAllServices(ContainerInterface $container): \Generator
    {
        foreach (self::SERVICES as $service) {
            yield $this->create($service, $container);
        }
    }
}
