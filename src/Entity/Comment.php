<?php

namespace App\Entity;

use App\Entity\Trait\SlugDescriptionTrait;
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment extends AbstractEntity
{
    use SlugDescriptionTrait;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Incidence $indicence = null;

    /**
     * @var Collection<int, CommentImage>
     */
    #[ORM\OneToMany(targetEntity: CommentImage::class, mappedBy: 'comment', orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIndicence(): ?Incidence
    {
        return $this->indicence;
    }

    public function setIndicence(?Incidence $indicence): static
    {
        $this->indicence = $indicence;

        return $this;
    }

    /**
     * @return Collection<int, CommentImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(CommentImage $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setComment($this);
        }

        return $this;
    }

    public function removeImage(CommentImage $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getComment() === $this) {
                $image->setComment(null);
            }
        }

        return $this;
    }
}
