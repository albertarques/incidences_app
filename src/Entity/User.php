<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends AbstractEntity
{
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    /**
     * @var Collection<int, Incidence>
     */
    #[ORM\OneToMany(targetEntity: Incidence::class, mappedBy: 'user')]
    private Collection $incidences;

    public function __construct()
    {
        $this->incidences = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

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
            $incidence->setUser($this);
        }

        return $this;
    }

    public function removeIncidence(Incidence $incidence): static
    {
        if ($this->incidences->removeElement($incidence)) {
            // set the owning side to null (unless already changed)
            if ($incidence->getUser() === $this) {
                $incidence->setUser(null);
            }
        }

        return $this;
    }
}
