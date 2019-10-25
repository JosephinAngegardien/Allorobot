<?php

namespace App\Entity;

use App\Entity\Avis;
use App\Entity\Particulier;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RobotsRepository")
 * @UniqueEntity(fields={"modele"}, message="Ce nom de modèle existe déjà.")
 */
class Robots
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
    private $modele;

    /**
     * @ORM\Column(type="integer")
     */
    private $tarif;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="robots", orphanRemoval=true)
     */
    private $avis;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $locomotion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CaracTech", inversedBy="robots")
     */
    private $caracs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="robots")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->lesavis = new ArrayCollection();
        $this->caracs = new ArrayCollection();
    }

    /**
     * Permet de récupérer le commentaire d'un particulier au sujet d'un robot.
     *
     * @param Particulier $author
     * @return Avis|null
     */
    public function getAvisFromAuthor(Particulier $author){
        foreach($this->lesavis as $avis) {
            if($avis->getAuthor() === $author) return $avis;
        }

        return null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->lesavis;
    }

    public function addAvis(Avis $avis): self
    {
        if (!$this->lesavis->contains($avis)) {
            $this->lesavis[] = $avis;
            $avis->setRobot($this);
        }

        return $this;
    }

    public function removeAvis(Avis $avis): self
    {
        if ($this->lesavis->contains($avis)) {
            $this->lesavis->removeElement($avis);
            // set the owning side to null (unless already changed)
            if ($avis->getRobot() === $this) {
                $avis->setRobot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CaracTech[]
     */
    public function getCaracs(): Collection
    {
        return $this->caracs;
    }

    public function addCarac(CaracTech $carac): self
    {
        if (!$this->caracs->contains($carac)) {
            $this->caracs[] = $carac;
        }

        return $this;
    }

    public function removeCarac(CaracTech $carac): self
    {
        if ($this->caracs->contains($carac)) {
            $this->caracs->removeElement($carac);
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setRobots($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getRobots() === $this) {
                $image->setRobots(null);
            }
        }

        return $this;
    }
}

