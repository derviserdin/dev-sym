<?php

namespace App\Controller;

use App\Entity\Gorev;

use App\Form\GorevType;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class CeviriController extends AbstractController
{

    /**
     * @Route("/ceviri")
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function new(TranslatorInterface $translator)
    {
        $message=$translator->trans('hello.user');
        return new Response($message);

    }


}