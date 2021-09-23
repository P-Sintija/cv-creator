<?php

namespace App\Fields;

class EmploymentField implements Field
{
    private string $institution;
    private string $position;
    private string $time;
    private ?string $description;
    private ?string $achievements;

    public function __construct(
        string $institution,
        string $position,
        string $time,
        ?string $description,
        ?string $achievements
    ) {
        $this->institution = $institution;
        $this->position = $position;
        $this->time = $time;
        $this->description = $description;
        $this->achievements = $achievements;
    }

    public function institution(): string
    {
        return $this->institution;
    }

    public function position(): string
    {
        return $this->position;
    }

    public function time(): string
    {
        return $this->time;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function achievements(): ?string
    {
        return $this->achievements;
    }
}
