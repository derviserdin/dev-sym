<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index()
    {
        return new JsonResponse(['Message' => 'Merhaba Dünya']);
    }
    /**
     * public function index(){
     * return new Response(content: "Merhaba Dünya");
     * } */

    /**   #[Route('/index', name: 'index')]
     * public function index(): Response
     * {
     * return $this->render('index/index.html.twig', [
     * 'controller_name' => 'IndexController',
     * ]);
     * }*/

    /**
     * @Route("/request", name="request_test")
     * @param RequestStack $requestStack
     */
    public function requestTest(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();
        // $_POST
        $name = $request->request->get('name');
        //$_GET , default olarak Derviş Atadım
        $request->query->get('name', 'Derviş');

        //$_COOKIE
        $request->cookies->get('username');

        //karşılıgı yok
        $request->attributes->get('name');

        //$_FILES
        $request->files->get('filename');

        //$_SERVER
        $serverData = $request->server->get('REMOTE_ADDR');


        $headers = $request->headers->all();
        var_dump($headers);
        exit();

    }

    /**
     * @Route("/response", name="response_test")
     * @param RequestStack $requestStack
     * @return Response
     */
    public function responseTest(RequestStack $requestStack)
    {
       //return new JsonResponse(['message' => 'Selam Derviş']);
        return $this->redirectToRoute('request_test');
    }


    //controller içinde servis kullanımı
    /**
     * @Route("/servis", name="servis_test")
     * @param SessionInterface $session
     * @return Response
     */
    public function serviceTest(SessionInterface $session){


        return new Response('Session ='.$session->getName());
    }

}
