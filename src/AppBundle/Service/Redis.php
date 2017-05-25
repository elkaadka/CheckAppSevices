<?php

namespace AppBundle\Service;

/**
 * class Redis
 *
 * class that checks if redis is up
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class Redis extends AbstractService
{
    const SERVICE_NAME = 'REDIS';

    /**
     * Checks if redis is up
     * @return bool
     */
    public function isUp(): bool
    {
        try {
            $redis = $this->container->get('snc_redis.default');
            $redis->connect();
            return $redis->isConnected();
        } catch (\Exception $exception) {
            return false;
        }

        return false;
    }
}