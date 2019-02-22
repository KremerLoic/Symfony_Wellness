<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 */

class Provider extends User
{


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Regex("/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/")
     *
     */
    private $emailProvider;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[a-zA-Z ]*$/")
     */
    private $name;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]+$/")
     */

    private $telNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]+$/")
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
     * @ORM\OneToOne(targetEntity="App\Entity\Images", mappedBy="logoProvider")
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Services", mappedBy="Provider")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="organiser")
     */
    private $stages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="provider")
     */
    private $Concern;



    public function __construct()
    {
        $this->photo = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->stages = new ArrayCollection();
        $this->Concern = new ArrayCollection();
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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {

        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_PROVIDER';

        return array_unique($roles);


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


    public function getLogo()
    {
        return $this->logo;
    }

    public function addLogo(Provider $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo = $logo;
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
            $service->addProvider($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeProvider($this);
        }

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setOrganiser($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getOrganiser() === $this) {
                $stage->setOrganiser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getConcern(): Collection
    {
        return $this->Concern;
    }

    public function addConcern(Comments $concern): self
    {
        if (!$this->Concern->contains($concern)) {
            $this->Concern[] = $concern;
            $concern->setProvider($this);
        }

        return $this;
    }

    public function removeConcern(Comments $concern): self
    {
        if ($this->Concern->contains($concern)) {
            $this->Concern->removeElement($concern);
            // set the owning side to null (unless already changed)
            if ($concern->getProvider() === $this) {
                $concern->setProvider(null);
            }
        }

        return $this;
    }


}
