<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit", inversedBy="service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstimateService", mappedBy="service", orphanRemoval=true)
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

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

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
            $estimateService->setService($this);
        }

        return $this;
    }

    public function removeEstimateService(EstimateService $estimateService): self
    {
        if ($this->estimateServices->contains($estimateService)) {
            $this->estimateServices->removeElement($estimateService);
            // set the owning side to null (unless already changed)
            if ($estimateService->getService() === $this) {
                $estimateService->setService(null);
            }
        }

        return $this;
    }
}
