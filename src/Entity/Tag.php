<?php

namespace App\Entity;

use App\Entity\Trait\SlugTagTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag extends AbstractEntity
{
    use SlugTagTrait;

    #[ORM\Column(length: 255)]
    private ?string $tag = null;

    /**
     * @var Collection<int, Incidence>
     */
    #[ORM\ManyToMany(targetEntity: Incidence::class, mappedBy: 'tags')]
    private Collection $incidences;

    public function __construct()
    {
        $this->incidences = new ArrayCollection();
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, Incidence>
     */
    public function getIncidences(): Collection
    {
        return $this->incidences;
    }

    public function addIncidence(Incidence $incidence): static
    {
        if (!$this->incidences->contains($incidence)) {
            $this->incidences->add($incidence);
            $incidence->addTag($this);
        }

        return $this;
    }

    public function removeIncidence(Incidence $incidence): static
    {
        if ($this->incidences->removeElement($incidence)) {
            $incidence->removeTag($this);
        }

        return $this;
    }
}
