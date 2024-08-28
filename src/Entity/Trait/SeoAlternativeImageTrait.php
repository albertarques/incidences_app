<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait SeoAlternativeImageTextTrait
{
    #[Gedmo\Translatable]
    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $seoAlternativeImageText = null;

    public function getSeoAlternativeImageText(): ?string
    {
        return $this->seoAlternativeImageText;
    }

    public function setSeoAlternativeImageText(?string $seoAlternativeImageText): self
    {
        $this->seoAlternativeImageText = $seoAlternativeImageText;

        return $this;
    }
}
