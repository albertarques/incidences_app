<?php

namespace App\Entity;

use App\Repository\IncidenceImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenceImageRepository::class)]
class IncidenceImage extends AbstractEntity
{
    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Incidence $incidence = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIncidence(): ?Incidence
    {
        return $this->incidence;
    }

    public function setIncidence(?Incidence $incidence): static
    {
        $this->incidence = $incidence;

        return $this;
    }
}
