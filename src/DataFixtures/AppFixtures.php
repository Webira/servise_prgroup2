<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i < 10; $i++)
        {

            $article = new Article();
            $article->setTitre("mon titre de l\ article $i")        
                    ->setContenu("contenu $i")
                    ->setDateDeCreation(new \Datetime("now"));

            $manager->persist($article);
        }
    
                // $product = new Product();

        // $manager->persist($product);

        $manager->flush();
    }

    
}
