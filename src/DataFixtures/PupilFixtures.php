<?php

namespace App\DataFixtures;

use App\Entity\Pupil;
use App\Repository\SchoolRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PupilFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var SchoolRepository */
    protected $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function load(ObjectManager $manager)
    {
        $schools = $this->schoolRepository->findAll();
        $i = 0;
        for($i = 0;$i <= 50;$i++){
            $pupil = new Pupil();
            $pupil->setFirstname("firstname_$i");
            $pupil->setLastname("lastname_$i");
            $pupil->setEmail("pupil_$i@gmail.com");
            $pupil->setSchool($schools[rand(0,count($schools)-1)]);
            $manager->persist($pupil);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SchoolFixtures::class];
    }
}
