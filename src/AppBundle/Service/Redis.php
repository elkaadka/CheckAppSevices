<?php

namespace AppBundle\Service;

use Predis\Client;

/**
 * class Redis
 *
 * class that checks if redis is up
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class Redis implements ServiceInterface
{
    protected $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Checks if redis is up
     * @return bool
     */
    public function isUp(): bool
    {
        try {
            $this->redis->connect();
            return $this->redis->isConnected();
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * returns the name of the redis service
     * @return string
     */
    public function getServiceName(): string
    {
       return 'REDIS';
    }
}