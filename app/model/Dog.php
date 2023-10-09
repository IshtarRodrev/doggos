<?php

class Dog extends BaseModel {

    static public function getTableName(): string
    {
        return "dogs";
    }

    public function getAttributes(): array
    {
        return [
            'id',
            'name',
            'breed',
            'material',
            'sound',
            'is_hunter',
        ];
    }

    public function __construct(
        protected ?int $id = null,
        protected string $name = "",
        protected int $breed = 0,
        protected int $material = 0,
        protected int $sound = 0,
        protected int $is_hunter = 0,
    )
    {
    }

    public function validation(): bool
    {
        if (strlen($this->name) > 64) {
            $this->addError('name', 'Кличка не может превышать 64 символа');
        }
        if ($this->breed == Breed::PUG->value && $this->is_hunter == 1) {
            $this->addError('is_hunter', ucfirst(Breed::PUG->toString() . ' слишком ленив, чтобы охотиться'));
        }
        if ($this->material != Material::FLESH->value && $this->is_hunter == 1) {
            $this->addError('is_hunter', 'Игрушки не умеют охотиться');
        }
        if ($this->material != Material::FLESH->value && $this->sound == Sound::BARK->value) {
            $this->addError('sound', 'Игрушки не умеют лаять');
        }

        return count($this->getErrors()) == 0;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName($called): void
    {
        $this->name = $called ?? "";
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setBreed($breed): void
    {
        $this->breed = $breed;
    }
    public function getBreed(): string
    {
        return $this->breed;
    }
    public function setMaterial($material): void
    {
        $this->material = $material;
    }
    public function getMaterial(): string
    {
        return $this->material;
    }
    public function setSound($sound): void
    {
        $this->sound = $sound;
    }
    public function getSound(): string
    {
        return $this->sound;
    }
    public function setIs_hunter($answer): void
    {
        $this->is_hunter = (int)$answer;
    }
    public function getIs_hunter(): int
    {
        return $this->is_hunter;
    }
}