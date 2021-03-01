<?php

namespace App\Entity;

use App\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PointageRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PointageRepository::class)
 */
class Pointage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_pointage;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Chantier::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $chantier;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->Chantier = new ArrayCollection();
        $this->date_pointage = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePointage()
    {
        return $this->date_pointage;
    }

    public function setDatePointage(DateTime $date_pointage): self
    {
        $this->date_pointage = $date_pointage;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    // public function addUser(User $user): self
    // {
    //     if (!$this->user->contains($user)) {
    //         $this->user[] = $user;
    //         $user->setPointages($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(User $user): self
    // {
    //     if ($this->user->removeElement($user)) {
    //         // set the owning side to null (unless already changed)
    //         if ($user->getPointages() === $this) {
    //             $user->setPointages(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    public function setChantier(?Chantier $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
    }

}
