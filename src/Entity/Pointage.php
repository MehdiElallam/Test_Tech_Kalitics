<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="pointages")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Chantier::class, mappedBy="Pointages")
     */
    private $Chantier;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->Chantier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePointage(): ?\DateTimeInterface
    {
        return $this->date_pointage;
    }

    public function setDatePointage(\DateTimeInterface $date_pointage): self
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

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setPointages($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPointages() === $this) {
                $user->setPointages(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chantier[]
     */
    public function getChantier(): Collection
    {
        return $this->Chantier;
    }

    public function addChantier(Chantier $chantier): self
    {
        if (!$this->Chantier->contains($chantier)) {
            $this->Chantier[] = $chantier;
            $chantier->setPointages($this);
        }

        return $this;
    }

    public function removeChantier(Chantier $chantier): self
    {
        if ($this->Chantier->removeElement($chantier)) {
            // set the owning side to null (unless already changed)
            if ($chantier->getPointages() === $this) {
                $chantier->setPointages(null);
            }
        }

        return $this;
    }

}
