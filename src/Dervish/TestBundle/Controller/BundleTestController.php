<?php

namespace App\Dervish\TestBundle\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BundleTestController extends AbstractController
{

    /**
     *
     * @Route("/test-bundle")
     * @return Response
     */

    public function hello()
    {
        return $this->render('@DervishTest/Merhaba/index.html.twig');
    }


}