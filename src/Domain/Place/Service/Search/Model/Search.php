<?php
namespace App\Domain\Place\Service\Search\Model;

use App\Domain\Place\Entity\Type;
use App\Domain\Place\Enum\Influx;
use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    #[Assert\Type("App\Domain\Place\Entity\Type")]
    private ?Type $type = null;

    #[Assert\Type("App\Domain\Place\Enum\Influx")]
    private ?Influx $influx = null;

    #[Assert\PositiveOrZero()]
    #[Assert\Choice([0, 1, 2, 3, 4, 5])]
    private ?int $ratings = null;

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getInflux(): ?Influx
    {
        return $this->influx;
    }

    public function setInflux(?Influx $influx): self
    {
        $this->influx = $influx;

        return $this;
    }

    public function getRatings(): ?int
    {
        return $this->ratings;
    }

    public function setRatings(?int $ratings): self
    {
        $this->ratings = $ratings;

        return $this;
    }
}
