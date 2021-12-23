<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends AbstractController
{

    /**
     * @Route("/asset_kontrol", name="asset_kontrol")
     * @return Response
     */
    public function index()
    {
        return $this->render('asset/index.html.twig');
    }


}
