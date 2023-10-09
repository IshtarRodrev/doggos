<?php

enum Material: int
{
    case FLESH  = 0;
    case PLUSH  = 1;
    case RUBBER = 2;

    public function toString(): string
    {
        return match ($this) {
            Material::FLESH  => "живая",
            Material::PLUSH  => "плюш",
            Material::RUBBER => "резина",
        };
    }
    public static function default(): Material
    {
        return self::FLESH;
    }
}
