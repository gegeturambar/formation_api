<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use App\Repository\SchoolRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeacherFixtures extends Fixture implements DependentFixtureInterface
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
        for($i = 0;$i <= 100;$i++){
            $teacher = new Teacher();
            $teacher->setFirstname('firstname_'.$i + 1);
            $teacher->setLastname('lastname_'.$i + 1);
            $teacher->setEmail("teacher_".($i + 1)."@gmail.com");
            $teacher->setSchool($schools[rand(0,count($schools)-1)]);
            $manager->persist($teacher);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SchoolFixtures::class];
    }
}
