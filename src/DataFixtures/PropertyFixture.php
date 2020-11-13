<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Property;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
     $faker= Factory::create('fr_FR');
    for($i=0;$i<100;$i++){

    $property =new Property();
    $property
    ->setTitle($faker->words(3,true))
     ->setDescription($faker->sentence(3,true))
      ->setSurface($faker->numberBetween(20,220))
       ->setRooms($faker->numberBetween(2,10))
        ->setBedrooms($faker->numberBetween(1,9))
         ->setFloor($faker->numberBetween(0,15))
          ->setPrice($faker->numberBetween(1600000,1500000))
           ->setHeat($faker->numberBetween(0,count(Property::HEAT) ,1))
            ->setCity($faker->city)
             ->setPostalCode($faker->postcode)
              ->setAddress($faker->address)
               ->setSold(false);
   $manager->persist($property);

    }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
