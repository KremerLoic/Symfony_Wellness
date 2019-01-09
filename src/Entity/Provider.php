<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 */

class Provider extends User
{


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailProvider;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tvaNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="photoProvider")
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="logoProvider")
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Services", mappedBy="Proposer")
     */
    private $services;



    public function __construct()
    {
        $this->photo = new ArrayCollection();
        $this->logo = new ArrayCollection();
        $this->services = new ArrayCollection();
    }


    public function getEmailProvider(): ?string
    {
        return $this->emailProvider;
    }

    public function setEmailProvider(string $emailProvider): self
    {
        $this->emailProvider = $emailProvider;

        return $this;
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

    public function getTelNumber(): ?string
    {
        return $this->telNumber;
    }

    public function setTelNumber(string $telNumber): self
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    public function getTvaNumber(): ?string
    {
        return $this->tvaNumber;
    }

    public function setTvaNumber(string $tvaNumber): self
    {
        $this->tvaNumber = $tvaNumber;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }



    /**
     * @return Collection|Images[]
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Images $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setPhotoProvider($this);
        }

        return $this;
    }

    public function removePhoto(Images $photo): self
    {
        if ($this->photo->contains($photo)) {
            $this->photo->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getPhotoProvider() === $this) {
                $photo->setPhotoProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Provider[]
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Provider $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo[] = $logo;
            $logo->setLogoProvider($this);
        }

        return $this;
    }

    public function removeLogo(Provider $logo): self
    {
        if ($this->logo->contains($logo)) {
            $this->logo->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getLogoProvider() === $this) {
                $logo->setLogoProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addProposer($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeProposer($this);
        }

        return $this;
    }


}
