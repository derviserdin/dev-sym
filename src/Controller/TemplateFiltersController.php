<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateFiltersController extends AbstractController
{

    /**
     * @Route("/template-filters", name="template_filters")
     * @return Response
     */
    public function index()
    {
        return $this->render("template-filter/index.html.twig", [
            'negativeVar' => -25,
            'sentece'=>'Merhaba ben Derviş',
            'bugun'=>new \DateTime(),
            'sehirler'=>[
                'Diyarbakır',
                'Mardin',
                'Urfa',
                'Antep'


            ],'rawData'=>'<h3>Selam Dünya</h3>'

        ]);
    }


}
