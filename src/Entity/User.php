<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string")
 * @ORM\DiscriminatorMap({"provider" = "Provider"})
 */
 abstract class User
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
                      private $number;
                  
                      /**
                       * @ORM\Column(type="string", length=255)
                       */
                      private $street;
                  
                      /**
                       * @ORM\Column(type="boolean")
                       */
                      private $banned;
                  
                      /**
                       * @ORM\Column(type="string", length=255)
                       */
                      private $email;
                  
                      /**
                       * @ORM\Column(type="boolean")
                       */
                      private $confirmed;
                  
                      /**
                       * @ORM\Column(type="date")
                       */
                      private $registration_date;
                  
                      /**
                       * @ORM\Column(type="string", length=255)
                       */
                      private $password;
                  
                      /**
                       * @ORM\Column(type="integer")
                       */
                      private $failed_try;
               
                      /**
                       * @ORM\ManyToOne(targetEntity="App\Entity\ZipCode", inversedBy="Adresse_CP")
                       */
                      private $zipCode;
      
                      /**
                       * @ORM\ManyToOne(targetEntity="App\Entity\Locality", inversedBy="Adresse_Locality")
                       */
                      private $locality;
                  
                       public function getId(): ?int
                       {
                           return $this->id;
                       }
                  
                  
                      public function getNumber(): ?string
                      {
                          return $this->number;
                      }
                  
                      public function setNumber(string $number): self
                      {
                          $this->number = $number;
                  
                          return $this;
                      }
                  
                      public function getStreet(): ?string
                      {
                          return $this->street;
                      }
                  
                      public function setStreet(string $street): self
                      {
                          $this->street = $street;
                  
                          return $this;
                      }
                  
                      public function getBanned(): ?bool
                      {
                          return $this->banned;
                      }
                  
                      public function setBanned(bool $banned): self
                      {
                          $this->banned = $banned;
                  
                          return $this;
                      }
                  
                      public function getEmail(): ?string
                      {
                          return $this->email;
                      }
                  
                      public function setEmail(string $email): self
                      {
                          $this->email = $email;
                  
                          return $this;
                      }
                  
                      public function getConfirmed(): ?bool
                      {
                          return $this->confirmed;
                      }
                  
                      public function setConfirmed(bool $confirmed): self
                      {
                          $this->confirmed = $confirmed;
                  
                          return $this;
                      }
                  
                      public function getRegistrationDate(): ?\DateTimeInterface
                      {
                          return $this->registration_date;
                      }
                  
                      public function setRegistrationDate(\DateTimeInterface $registration_date): self
                      {
                          $this->registration_date = $registration_date;
                  
                          return $this;
                      }
                  
                      public function getPassword(): ?string
                      {
                          return $this->password;
                      }
                  
                      public function setPassword(string $password): self
                      {
                          $this->password = $password;
                  
                          return $this;
                      }
                  
                      public function getFailedTry(): ?int
                      {
                          return $this->failed_try;
                      }
                  
                      public function setFailedTry(int $failed_try): self
                      {
                          $this->failed_try = $failed_try;
                  
                          return $this;
                      }
            
                      public function getZipCode(): ?ZipCode
                      {
                          return $this->zipCode;
                      }
         
                      public function setZipCode(?ZipCode $zipCode): self
                      {
                          $this->zipCode = $zipCode;
         
                          return $this;
                      }
   
                      public function getLocality(): ?Locality
                      {
                          return $this->locality;
                      }

                      public function setLocality(?Locality $locality): self
                      {
                          $this->locality = $locality;

                          return $this;
                      }
                  
                  }
