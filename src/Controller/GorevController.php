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


class GorevController extends AbstractController
{

    /**
     * @Route("/yeni-gorev", name="yeni_gorev")
     * @return Response
     */
    public function new(Request $request, ManagerRegistry $doctrine)
    {

        $gorev = new Gorev();


        $form = $this->createForm(GorevType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $data = $form->getNormData();

            /**
             * @var Gorev $gorev
             */
            $gorev = $form->getData();
            $entityManager->persist($gorev);
            $entityManager->flush();

            return $this->redirectToRoute('gorevler');
        }

        return $this->render('gorev/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gorevler", name="gorevler")
     * @return Response
     */
    public function list(Request $request, ManagerRegistry $doctrine,LoggerInterface $logger)
    {
        $logger->error('Bir hata oluştu');
        $logger->info('İşlem başarılı');
        $entityManager = $doctrine->getManager();
        $gorevler = $entityManager->getRepository(Gorev::class)->findAll();


        return $this->render('gorev/index.html.twig', [
            'gorevler' => $gorevler,
        ]);

    }


    /**
     * @Route("/gorevler/sil{id}", name="gorev-sil")
     * @return Response
     */
    public function remove(Request $request, ManagerRegistry $doctrine, Gorev $gorev)
    {
        $entityManager = $doctrine->getManager();
        /** Token alma */
        $gonderilenToken = $request->get('token');
        if ($this->isCsrfTokenValid('gorev-sil', $gonderilenToken)) {
           $entityManager->remove($gorev);
           $entityManager->flush();
            return new Response('Başarıyla silindi!');
        }

        return new Response('Geçersiz Token');

    }


    /**
     * @Route("/denemee", name="ceviri")
     * @return Response
     */
    public function index(Request $request, TranslatorInterface $translator)
    {
        $message=$translator->trans('hello.message');

        return new Response($message);

    }

}