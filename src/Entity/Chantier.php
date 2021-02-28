<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChantierRepository;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=ChantierRepository::class)
 */
class Chantier
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $Nom;

    /**
     * @ORM\Column(type="text")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\ManyToOne(targetEntity=Pointage::class, inversedBy="Chantier")
     */
    private $Pointages;

    public function __construct(){
        // $this->date_debut = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getDateDebut()
    {
        return $this->date_debut;
    }

    public function setDateDebut(DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getPointages(): ?Pointage
    {
        return $this->Pointages;
    }

    public function setPointages(?Pointage $Pointages): self
    {
        $this->Pointages = $Pointages;

        return $this;
    }
}
