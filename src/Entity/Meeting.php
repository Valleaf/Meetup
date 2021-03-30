<?php

namespace App\Entity;

use App\Repository\MeetingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetingRepository::class)
 */
class Meeting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeStarting;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registerUntil;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxParticipants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $information;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="organiserOf")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisedBy;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="meetings")
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
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

    public function getTimeStarting(): ?\DateTimeInterface
    {
        return $this->timeStarting;
    }

    public function setTimeStarting(\DateTimeInterface $timeStarting): self
    {
        $this->timeStarting = $timeStarting;

        return $this;
    }

    public function getLength(): ? int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getRegisterUntil(): ?\DateTimeInterface
    {
        return $this->registerUntil;
    }

    public function setRegisterUntil(\DateTimeInterface $registerUntil): self
    {
        $this->registerUntil = $registerUntil;

        return $this;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants(int $maxParticipants): self
    {
        $this->maxParticipants = $maxParticipants;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getOrganisedBy(): ?User
    {
        return $this->organisedBy;
    }

    public function setOrganisedBy(?User $organisedBy): self
    {
        $this->organisedBy = $organisedBy;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->addMeeting($this);
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            $participant->removeMeeting($this);
        }

        return $this;
    }
}
