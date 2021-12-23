<?php

namespace App\Controller;



use App\Entity\Kontrol;

use App\Form\KontrolType;
use App\Repository\UrunRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;


class KontrolController extends AbstractController
{

    /**
     * @Route("/form-kontrol")
     * @return Response
     */

    public function safSql(Request $request)
    {
        $kontrol = new Kontrol();


        $form = $this->createForm(KontrolType::class,$kontrol);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
             return new Response('form kontrolden başarıyla geçti');
        }
        if($form->isSubmitted()){
            $errors=$form->getErrors(true);
            foreach ($errors as $item) {
                echo $item->getMessage().'<hr>';
            }
        }

        return $this->render('kontrol/new.html.twig', [
            'form' => $form->createView()
        ]);
    }




}