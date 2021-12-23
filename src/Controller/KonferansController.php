<?php

namespace App\Controller;

use App\Entity\Gorev;

use App\Entity\Konferans;

use App\Form\KonferansType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;


class KonferansController extends AbstractController
{

    /**
     * @Route("/yeni-konferans", name="yeni_konferans")
     * @return Response
     */
    public function new(Request $request,ManagerRegistry $doctrine)
    {

        $konferans = new Konferans();


        $form = $this->createForm(KonferansType::class,$konferans);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$doctrine->getManager();

            /** @var UploadedFile $file */
            $file=$form->get('afis')->getData();
            //var_dump(get_class($file));exit();

            $fileName=$this->rastgeleIsim().'.'.$file->guessExtension();
            $konferans->setAfis($fileName);
            $em->persist($konferans);
            $em->flush();
           // var_dump($fileName);exit();
            $file->move($this->getParameter('afis_folder'),$fileName);

           // return new  Response('Dosya yükleme başarılı');
            return  $this->redirectToRoute('konferanslar');


        }

        return $this->render('konferans/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/konferanslar", name="konferanslar")
     * @return Response
     */
    public function list(Request $request,ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $konferanslar=$entityManager->getRepository(Konferans::class)->findAll();
        return  $this->render('konferans/index.html.twig',[
            'konferanslar'=>$konferanslar,
        ]);

    }

    private function rastgeleIsim(){
        return md5(uniqid());
    }


}