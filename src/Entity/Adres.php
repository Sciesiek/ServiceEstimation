<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresRepository")
 */
class Adres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $housingNumber;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $postal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="adres")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Estimate", mappedBy="adres", cascade={"persist", "remove"})
     */
    private $estimate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHousingNumber(): ?string
    {
        return $this->housingNumber;
    }

    public function setHousingNumber(?string $housingNumber): self
    {
        $this->housingNumber = $housingNumber;

        return $this;
    }

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(?string $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getEstimate(): ?Estimate
    {
        return $this->estimate;
    }

    public function setEstimate(?Estimate $estimate): self
    {
        $this->estimate = $estimate;

        // set (or unset) the owning side of the relation if necessary
        $newAdres = null === $estimate ? null : $this;
        if ($estimate->getAdres() !== $newAdres) {
            $estimate->setAdres($newAdres);
        }

        return $this;
    }
}
