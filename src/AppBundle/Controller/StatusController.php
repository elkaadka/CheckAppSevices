<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusController extends Controller
{
    /**
     * @Route("/status", name="status_page")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $data = ['APP' => false, 'MYSQL' => false, 'REDIS' => false];
        return new JsonResponse($data);
    }
}
