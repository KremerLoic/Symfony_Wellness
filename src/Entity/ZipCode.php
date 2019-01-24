<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZipCodeRepository")
 */
class ZipCode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $zipcode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="zipCode")
     */
    private $Adresse_CP;

    public function __construct()
    {
        $this->Adresse_CP = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->zipcode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }


    /**
     * @return Collection|User[]
     */
    public function getAdresseCP(): Collection
    {
        return $this->Adresse_CP;
    }

    public function addAdresseCP(User $adresseCP): self
    {
        if (!$this->Adresse_CP->contains($adresseCP)) {
            $this->Adresse_CP[] = $adresseCP;
            $adresseCP->setZipCode($this);
        }

        return $this;
    }

    public function removeAdresseCP(User $adresseCP): self
    {
        if ($this->Adresse_CP->contains($adresseCP)) {
            $this->Adresse_CP->removeElement($adresseCP);
            // set the owning side to null (unless already changed)
            if ($adresseCP->getZipCode() === $this) {
                $adresseCP->setZipCode(null);
            }
        }

        return $this;
    }
}
