<?php

declare(strict_types=1);

namespace App\Domain\Place\Entity;

use App\Domain\Place\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Place::class, inversedBy: 'types')]
    /** @phpstan-ignore-next-line */
    private $places;

    public function __construct()
    {
        $this->places = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<Place>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        $this->places->removeElement($place);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
