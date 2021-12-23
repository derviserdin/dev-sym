<?php

namespace App\Controller;

use App\Entity\Grup;
use App\Entity\Kategori;
use App\Entity\Urun;
use App\Entity\User;
use App\Repository\UrunRepository;
use App\Service\MessageGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DoctrineController extends UrunRepository
{

    /**
     * @Route("/saf-sq")
     * @return void
     */

    public function safSql()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM urun LIMIT 5
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sonuc = $stmt->executeStatement();
        // returns an array of arrays (i.e. a raw data set)
        //  return $stmt->fetchAllAssociative();
        var_dump($sonuc);
        exit();
    }

    /**
     * @Route("/many-to-one-veri-kaydetme")
     */
    public function manyToOneVeriKaydetme(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $kategori = new Kategori();
        $kategori->setIsim('Spor Giyim Yeni Kategori');


        $urunn = new Urun();
        $urunn->setIsim('Koşu Ayakkabısı');
        $urunn->setKategori($kategori);
        $urunn->setFiyat(91);
        $urunn->setAciklama('bu Deneme açıklaması');
        $urunn->setTag('burası Tag');
        $urunn->setPerformans(10);
        //$urun->setOzelFiyat(10);

        $urunn1 = new Urun();
        $urunn1->setIsim('Esofman');
        $urunn1->setKategori($kategori);
        $urunn1->setFiyat(50);
        $urunn1->setAciklama('bu Deneme açıklaması');
        $urunn1->setTag('burası Tag');
        $urunn1->setPerformans(10);
        //$urun->setOzelFiyat(10);

        $urunn2 = new Urun();
        $urunn2->setIsim('Spor Atlet');
        $urunn2->setKategori($kategori);
        $urunn2->setFiyat(30);
        $urunn2->setAciklama('bu Deneme açıklaması');
        $urunn2->setTag('burası Tag');
        $urunn2->setPerformans(10);
        //$urun->setOzelFiyat(10);


        $entityManager->persist($kategori);
        $entityManager->persist($urunn);
        $entityManager->persist($urunn1);
        $entityManager->persist($urunn2);

        $entityManager->flush();

        return new Response('Urün Kaydedildi ürün id:');

    }

    /**
     * @Route("/many-to-one-veri-inceleme/{id}")
     */
    public function manyToOneVeriInceleme(Urun $urun)
    {
        // $entityManager = $doctrine->getManager();
        $kategori = $urun->getKategori();
        return new Response('Urun id: %s ->', $urun->getId(), $kategori->getIsim());
    }

    /**
     * @Route("/many-to-many-veri-inceleme/{id}")
     */
    public function manyToManyVeriInceleme(Kategori $kategori)
    {
        $urunlerr = $kategori->getUrunler();

        foreach ($urunlerr as $urun) {

            echo $urun->getIsim() . '<hr>';
        }
        return new Response('');
    }

    /**
     * @Route("/relation-query-builder-inceleme/{id}")
     */
    public function relationQueryBuilder(Kategori $kategori)
    {
        $em = $this->getEntityManager();
        $urunrepo = $em->getRepository(Urun::class);
        $urunler = $urunrepo->finByCategory($kategori);

        foreach ($urunler as $urun) {
            echo $urun->getIsim() . '<hr>';
        }
        return new Response('');
    }


    /**
     * @Route("/many-to-many-veri-kaydetme")
     */
    public function manyToManyVeriKaydetme(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $user1 = new User();
        $user1->setIsim('Derviş');
        $user1->setUsername('Dervish');

        $user2 = new User();
        $user2->setIsim('Üveys');
        $user2->setUsername('Uveys');

        $user3 = new User();
        $user3->setIsim('Bilal');
        $user3->setUsername('bilal');

        $grup1 = new Grup();
        $grup1->setIsim('Admin');

        $grup2 = new Grup();
        $grup2->setIsim('Editor');

        $grup1->addUser($user1);
        $grup1->addUser($user2);

        $grup2->addUser($user2);
        $grup2->addUser($user3);


        $entityManager->persist($user1);
        $entityManager->persist($user2);
        $entityManager->persist($user3);
        $entityManager->persist($grup1);
        $entityManager->persist($grup2);


        $entityManager->flush();
        return new Response('Urün Kaydedildi ürün id:');

    }


}