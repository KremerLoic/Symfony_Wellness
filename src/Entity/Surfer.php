<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurferRepository")
 */
class Surfer extends User
{


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="surfer", cascade={"persist","remove"})
     */
    private $draft;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Images", cascade={"persist","remove"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $photo;


    public function __construct()
    {
        $this->draft = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }



    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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
        $roles[] = 'ROLE_SURFER';

        return array_unique($roles);


    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getDraft(): Collection
    {
        return $this->draft;
    }

    public function addDraft(Comments $draft): self
    {
        if (!$this->draft->contains($draft)) {
            $this->draft[] = $draft;
            $draft->setSurfer($this);
        }

        return $this;
    }

    public function removeDraft(Comments $draft): self
    {
        if ($this->draft->contains($draft)) {
            $this->draft->removeElement($draft);
            // set the owning side to null (unless already changed)
            if ($draft->getSurfer() === $this) {
                $draft->setSurfer(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?Images
    {
        return $this->photo;
    }

    public function setPhoto(?Images $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
