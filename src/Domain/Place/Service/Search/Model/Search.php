<?php

declare(strict_types=1);

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

    private ?string $query = null;

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

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): self
    {
        $this->query = $query;

        return $this;
    }
}
