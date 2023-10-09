<?php

enum Breed: int
{
    case LABRADOR  = 4;
    case DACHSHUND = 3;
    case PUG       = 2;
    case SHIBAINU  = 1;
    case UNKNOWN   = 0;

    public function toString(): string
    {
        return match ($this) {
            Breed::UNKNOWN => '???',
            Breed::SHIBAINU => 'сиба-ину',
            Breed::PUG => 'мопс',
            Breed::DACHSHUND => 'такса',
            Breed::LABRADOR => 'лабрадор',
        };
    }

    public static function default(): Breed
    {
        return self::UNKNOWN;
    }
}