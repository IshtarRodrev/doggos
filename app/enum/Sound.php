<?php

enum Sound: int
{
//    case SNARL  = 5;
//    case GROWL  = 4;
//    case WOOF   = 3;
    case SQUEAK = 2;
    case BARK   = 1;
    case SILENT = 0;

    public function toString(): string
    {
        return match ($this) {
            Sound::SILENT => "...",
            Sound::BARK => "лай",
            Sound::SQUEAK => "писк",
//            Sound::WOOF => "гав",
//            Sound::GROWL => "рычание",
//            Sound::SNARL => "рык",
        };
    }
    public static function default(): Sound
    {
        return self::SILENT;
    }
}
