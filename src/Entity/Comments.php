<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex("/^(1[0]|[1-9])$/",
     * message="'{{ value }}' ne correspond pas (1-10)")
     *
     */
    private $note;

    /**
     * @ORM\Column(type="date")
     */
    private $encode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Surfer", inversedBy="draft")
     */
    private $surfer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="Concern")
     */
    private $provider;

    public function __toString()
    {
        return $this->content;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEncode(): ?\DateTimeInterface
    {
        return $this->encode;
    }

    public function setEncode(\DateTimeInterface $encode): self
    {
        $this->encode = $encode;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSurfer(): ?Surfer
    {
        return $this->surfer;
    }

    public function setSurfer(?Surfer $surfer): self
    {
        $this->surfer = $surfer;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
