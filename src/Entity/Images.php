<?php

namespace App\Entity;

use App\Cloudinary\Cloudinary;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="logo")
     */
    private $logoProvider;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="photo")
     */
    private $photoProvider;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getLogoProvider(): ?Provider
    {
        return $this->logoProvider;
    }

    public function setLogoProvider(?Provider $provider): self
    {
        $this->logoProvider = $provider;

        return $this;
    }

    public function getPhotoProvider(): ?Provider
    {
        return $this->photoProvider;
    }

    public function setPhotoProvider(?Provider $photoProvider): self
    {
        $this->photoProvider = $photoProvider;

        return $this;
    }

    public function __toString()
    {
        Cloudinary::connect();

        return cloudinary_url($this->image);
    }
}
