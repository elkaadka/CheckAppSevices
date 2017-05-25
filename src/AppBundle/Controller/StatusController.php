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

        //Got through all the services Known to check if they are up and running
        $serviceFactory = new ServiceFactory();
        foreach ($serviceFactory->getAllServices($this->container) as $service) {
            //add the service to the data
            $data[$service::SERVICE_NAME] = $service->isUp();
        }

        //if all the services are ok, the APP is OK, if one is KO, the app is KO
        $data['APP'] = (bool)array_product($data);

        return new JsonResponse($data);
    }
}
