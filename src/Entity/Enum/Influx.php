<?php
namespace App\Entity\Enum;

enum Influx: string
{
    case Low = 'Few people';
    case Medium = 'Moderate';
    case High = 'Many people';
}
