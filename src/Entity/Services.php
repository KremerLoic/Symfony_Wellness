<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 */
class Services
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $highlight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Provider", inversedBy="services")
     */
    private $Proposer;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->Proposer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHighlight(): ?string
    {
        return $this->highlight;
    }

    public function setHighlight(string $highlight): self
    {
        $this->highlight = $highlight;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    /**
     * @return Collection|Provider[]
     */
    public function getProposer(): Collection
    {
        return $this->Proposer;
    }

    public function addProposer(Provider $proposer): self
    {
        if (!$this->Proposer->contains($proposer)) {
            $this->Proposer[] = $proposer;
        }

        return $this;
    }

    public function removeProposer(Provider $proposer): self
    {
        if ($this->Proposer->contains($proposer)) {
            $this->Proposer->removeElement($proposer);
        }

        return $this;
    }
}
