<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracTechRepository")
 */
class CaracTech
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Robots", mappedBy="caracs")
     */
    private $robots;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->robots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Robots[]
     */
    public function getRobots(): Collection
    {
        return $this->robots;
    }

    public function addRobot(Robots $robot): self
    {
        if (!$this->robots->contains($robot)) {
            $this->robots[] = $robot;
            $robot->addCarac($this);
        }

        return $this;
    }

    public function removeRobot(Robots $robot): self
    {
        if ($this->robots->contains($robot)) {
            $this->robots->removeElement($robot);
            $robot->removeCarac($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
