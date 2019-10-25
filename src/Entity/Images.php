<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=4095)
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Robots", inversedBy="images")
     */
    private $robots;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getRobots(): ?Robots
    {
        return $this->robots;
    }

    public function setRobots(?Robots $robots): self
    {
        $this->robots = $robots;

        return $this;
    }
}
