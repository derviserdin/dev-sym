<?php

namespace App\DataFixtures;

use App\Entity\Urun;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create();
        for ($i=0;$i<=20;$i++){
            $product = new Urun();
            $product
                ->setIsim($faker->name())
                ->setAciklama($faker->address())
                ->setFiyat(rand(0,100))
                ->setPerformans(10)
                ->setTag('data,fixture');
            $manager->persist($product);
        }


       $manager->flush();
    }
}
