<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $services = new Services();

            $services->setDescription("desc_$i");
            $services->setHighlight("Highlight_$i");
            $services->setIsValid(true);
            $services->setLogin("Login_$i");
            $services->setName("Name_$i");


            $manager->persist($services);


        }
        $manager->flush();
    }
}
