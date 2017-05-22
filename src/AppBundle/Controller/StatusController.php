<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    /**
     * @Route("/status", name="status_page")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return new Response('/status/ route done');
    }
}
