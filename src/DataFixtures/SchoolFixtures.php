<?php

namespace App\DataFixtures;

use App\Entity\School;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SchoolFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $name = 'School';
        $i = 0;
        for($i = 0;$i <= 10;$i++){
            $school = new School();
            $school->setName($name.'_'.$i);
            $manager->persist($school);
        }
        $manager->flush();
    }
}
