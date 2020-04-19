<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstimateRepository")
 */
class Estimate
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adres", inversedBy="estimate", cascade={"persist", "remove"})
     */
    private $adres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="estimates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstimateService", mappedBy="estimate", orphanRemoval=true)
     */
    private $estimateServices;

    public function __construct()
    {
        $this->estimateServices = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdres(): ?Adres
    {
        return $this->adres;
    }

    public function setAdres(?Adres $adres): self
    {
        $this->adres = $adres;

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

    /**
     * @return Collection|EstimateService[]
     */
    public function getEstimateServices(): Collection
    {
        return $this->estimateServices;
    }

    public function addEstimateService(EstimateService $estimateService): self
    {
        if (!$this->estimateServices->contains($estimateService)) {
            $this->estimateServices[] = $estimateService;
            $estimateService->setEstimate($this);
        }

        return $this;
    }

    public function removeEstimateService(EstimateService $estimateService): self
    {
        if ($this->estimateServices->contains($estimateService)) {
            $this->estimateServices->removeElement($estimateService);
            // set the owning side to null (unless already changed)
            if ($estimateService->getEstimate() === $this) {
                $estimateService->setEstimate(null);
            }
        }

        return $this;
    }
}
