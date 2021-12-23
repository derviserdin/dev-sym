<?php

namespace App\Controller;

use App\Service\MessageGenerator;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{

    /**
     *
     * @Route("/hello")
     * @param MessageGenerator $messageGenerator
     * @return Response
     */

    public function hello(MessageGenerator $messageGenerator)
    {
        //$messageGenerator = $this->container->get(MessageGenerator::class);
        return new Response($messageGenerator->helloMessage());
    }


}