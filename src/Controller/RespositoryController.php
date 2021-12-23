<?php

namespace App\Controller;

use App\Entity\Urun;
use App\Service\MessageGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RespositoryController extends AbstractController
{

    /**
     *
     * @Route("/repository/test/{fiyat}")
     * @param MessageGenerator $messageGenerator
     * @return Response
     */

    public function index(ManagerRegistry  $doctrine,$fiyat)
    {
        $entityManager=$doctrine->getManager();
        $urunrepo=$entityManager->getRepository(Urun::class)->findAllGreateThan($fiyat);
        return $this->render('urun/index.html.twig',[
                'urunler' => $urunrepo
            ]);
    }


}