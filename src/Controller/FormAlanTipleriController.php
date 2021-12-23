<?php

namespace App\Controller;

use App\Entity\Gorev;

use App\Form\AlanTipleri;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;


class FormAlanTipleriController extends AbstractController
{

    /**
     * @Route("/form-alan-tipleri")
     * @return Response
     */
    public function new(Request $request )
    {
        $form = $this->createForm(AlanTipleri::class);

        return $this->render('gorev/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


}