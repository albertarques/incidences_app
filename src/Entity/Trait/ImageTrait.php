<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

trait ImageTrait
{
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    protected ?string $image = null;

    public function getMainImage(): ?string
    {
        return $this->image;
    }

    public function setMainImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMainImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setMainImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }
}
