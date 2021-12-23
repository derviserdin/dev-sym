<?php

namespace App\Controller;
use App\Entity\Urun;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UrunController extends AbstractController
{

    /**
     * @Route("/urunler", name="urun_index")
     * @return Response
     */
    public function index(ManagerRegistry $doctrine)
    {
        $product = $doctrine->getRepository(Urun::class)->findAll();
       // $urunRepository=$doctrine->getRepository(Urun::class)->find();
        //$urunRepository=$this->getDoctrine()->getRepository(Urun::class);
     //   $urunler=$urunRepository->findAll();
        return $this->render('urun/index.html.twig',[
            'urunler'=>$product,
        ]);

    }

    /**
     * @Route("/urunler/create", name="urun_create")
     * @return Response
     */
    public function create(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $product = new Urun();
        $product
            ->setIsim('Bilal Gömlek')
            ->setAciklama('Bu Derviş in özel gömleği')
            ->setFiyat(100);


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());

    }

    /**
     * @Route("/urunler/{id}", name="urun_show")
     * @return Response
     */
    public function show(Urun $urun)
    {
        //$entityManager = $doctrine->getRepository(Urun::class)->find($id);



        return new Response('geldi '.$urun->getIsim());

    }

    /**
     * @Route("/urunler/update/{id}", name="urun_update")
     * @return Response
     */
    public function update(Request $request,ManagerRegistry  $doctrine,int $id)
    {

        $isim=$request->get('isim');
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Urun::class)->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'Ürun bulunamadı '.$id
            );
        }

        $product
            ->setIsim($isim)->setFiyat(rand(10,100));

      //  $entityManager->persist($product);
        $entityManager->flush();


        return new Response('ürün kaydedildi '.$product->getIsim());

    }

    /**
     * @Route("/urunler/delete/{id}", name="urun_delete")
     * @return Response
     */
    public function delete(ManagerRegistry $doctrine,int $id)
    {
        $entityManager = $doctrine->getManager();
        $product = $doctrine->getRepository(Urun::class)->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'Ürun bulunamadı '.$id
            );
        }
        $entityManager->remove($product);
        $entityManager->flush();
        return new Response('Ürün başarı ile silindi'.$product->getIsim());

    }

}
