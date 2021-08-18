<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
#[ApiResource]
class School
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getPupil"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"getPupil"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="school", orphanRemoval=true)
     */
    private $rooms;

    /**
     * @ORM\OneToMany(targetEntity=Teacher::class, mappedBy="school")
     */
    private $teachers;

    /**
     * @ORM\OneToMany(targetEntity=Pupil::class, mappedBy="school")
     */
    private $pupils;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->pupils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setSchool($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getSchool() === $this) {
                $room->setSchool(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Teacher[]
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
            $teacher->setSchool($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): self
    {
        if ($this->teachers->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getSchool() === $this) {
                $teacher->setSchool(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pupil[]
     */
    public function getPupils(): Collection
    {
        return $this->pupils;
    }

    public function addPupil(Pupil $pupil): self
    {
        if (!$this->pupils->contains($pupil)) {
            $this->pupils[] = $pupil;
            $pupil->setSchool($this);
        }

        return $this;
    }

    public function removePupil(Pupil $pupil): self
    {
        if ($this->pupils->removeElement($pupil)) {
            // set the owning side to null (unless already changed)
            if ($pupil->getSchool() === $this) {
                $pupil->setSchool(null);
            }
        }

        return $this;
    }
}
