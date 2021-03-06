<?php

declare(strict_types=1);

namespace App\Domain\Place\Enum;

enum Influx: string
{
    case Low = 'Few people';
    case Medium = 'Moderate';
    case High = 'Many people';
    public function color(): string
    {
        return match ($this) {
            Influx::Low => 'success',
            Influx::Medium => 'info',
            Influx::High => 'danger',
        };
    }
}
