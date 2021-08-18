<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['getCourse']]
)]
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getCourse","getPupil"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Pupil::class, inversedBy="courses")
     * @Groups({"getCourse"})
     */
    private $pupils;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"getCourse","getPupil"})
     */
    private $teacher;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"getCourse","getPupil"})
     */
    private $start_datetime;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"getCourse","getPupil"})
     */
    private $end_datetime;

    public function __construct()
    {
        $this->pupils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        }

        return $this;
    }

    public function removePupil(Pupil $pupil): self
    {
        $this->pupils->removeElement($pupil);

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->start_datetime;
    }

    public function setStartDatetime(\DateTimeInterface $start_datetime): self
    {
        $this->start_datetime = $start_datetime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeInterface
    {
        return $this->end_datetime;
    }

    public function setEndDatetime(\DateTimeInterface $end_datetime): self
    {
        $this->end_datetime = $end_datetime;

        return $this;
    }
}
