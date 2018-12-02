<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalityRepository")
 */
class Locality
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
    private $locality;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="locality")
     */
    private $Adresse_Locality;

    public function __construct()
    {
        $this->Adresse_Locality = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAdresseLocality(): Collection
    {
        return $this->Adresse_Locality;
    }

    public function addAdresseLocality(User $adresseLocality): self
    {
        if (!$this->Adresse_Locality->contains($adresseLocality)) {
            $this->Adresse_Locality[] = $adresseLocality;
            $adresseLocality->setLocality($this);
        }

        return $this;
    }

    public function removeAdresseLocality(User $adresseLocality): self
    {
        if ($this->Adresse_Locality->contains($adresseLocality)) {
            $this->Adresse_Locality->removeElement($adresseLocality);
            // set the owning side to null (unless already changed)
            if ($adresseLocality->getLocality() === $this) {
                $adresseLocality->setLocality(null);
            }
        }

        return $this;
    }
}
