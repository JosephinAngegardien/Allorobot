<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Robots", inversedBy="avis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $robot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Particulier", inversedBy="avis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * Permet de mettre en place la date de création
     *
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function prePersist() {
        if(empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getRobot(): ?Robots
    {
        return $this->robot;
    }

    public function setRobot(?Robots $robot): self
    {
        $this->robot = $robot;

        return $this;
    }

    public function getAuthor(): ?Particulier
    {
        return $this->author;
    }

    public function setAuthor(?Particulier $author): self
    {
        $this->author = $author;

        return $this;
    }
}
