<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adres", mappedBy="client")
     */
    private $adres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Estimate", mappedBy="client", orphanRemoval=true)
     */
    private $estimates;

    private $form;

    public function __construct()
    {
        $this->adres = new ArrayCollection();
        $this->estimates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return Collection|Adres[]
     */
    public function getAdres(): Collection
    {
        return $this->adres;
    }

    public function addAdre(Adres $adre): self
    {
        if (!$this->adres->contains($adre)) {
            $this->adres[] = $adre;
            $adre->setClient($this);
        }

        return $this;
    }

    public function removeAdre(Adres $adre): self
    {
        if ($this->adres->contains($adre)) {
            $this->adres->removeElement($adre);
            // set the owning side to null (unless already changed)
            if ($adre->getClient() === $this) {
                $adre->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Estimate[]
     */
    public function getEstimates(): Collection
    {
        return $this->estimates;
    }

    public function addEstimate(Estimate $estimate): self
    {
        if (!$this->estimates->contains($estimate)) {
            $this->estimates[] = $estimate;
            $estimate->setClient($this);
        }

        return $this;
    }

    public function removeEstimate(Estimate $estimate): self
    {
        if ($this->estimates->contains($estimate)) {
            $this->estimates->removeElement($estimate);
            // set the owning side to null (unless already changed)
            if ($estimate->getClient() === $this) {
                $estimate->setClient(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getName()." ".$this->getSurname();
    }

}
