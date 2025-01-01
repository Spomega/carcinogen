<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost = new MicroPost();
        $microPost->setTitle('Welcome to the Carcinogen');
        $microPost->setText('This is the first post on Carcinogen');
        $microPost->setCreated(new \DateTime());
        $manager->persist($microPost);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to the US');
        $microPost2->setText('This is the first post on US');
        $microPost2->setCreated(new \DateTime());
        $manager->persist($microPost2);

        $manager->flush();
    }
}
