<?php

namespace App\DataFixtures;

use App\Entity\Room;
use App\Repository\SchoolRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements DependentFixtureInterface
{
    protected $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function load(ObjectManager $manager)
    {
        $schools = $this->schoolRepository->findAll();
        $j = 0;
        foreach($schools as $school) {
            $j++;
            $maxRooms = rand(4,20);
            for ($i = 0; $i <= $maxRooms; $i++) {
                $room = new Room();
                $room->setName('Room_' . $j + 1);
                $room->setSchool($school);
                $manager->persist($room);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SchoolFixtures::class];
    }
}
