<?php

namespace AppBundle\Controller;

use AppBundle\Service\Mysql;
use AppBundle\Service\Redis;
use AppBundle\Service\ServiceFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusController extends Controller
{
    /**
     * This route checks the status of the  following services :
     *   - Mysql
     *   - Redis
     *
     * @Route("/status", name="status_page")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        //init the array that will be sent as json to APP: true
        $data = ['APP' => true];

        //check if mysql is up
        $mysql = $this->get('service_mysql');
        $data[$mysql->getServiceName()] = $mysql->isUp();

        //check if redis is up
        $redis = $this->get('service_redis');
        $data[$redis->getServiceName()] = $redis->isUp();

        //if all the services are ok, the APP is OK, if one is KO, the app is KO
        $data['APP'] = (bool)array_product($data);

        //send the data
        return new JsonResponse($data);
    }
}
