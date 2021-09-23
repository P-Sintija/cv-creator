<?php

namespace App\Fields;

class EducationField implements Field
{
    private string $institution;
    private ?string $faculty;
    private ?string $level;
    private string $statuss;
    private string $time;

    public function __construct(
        string $institution,
        ?string $faculty,
        ?string $level,
        string $statuss,
        string $time
    ) {
        $this->institution = $institution;
        $this->faculty = $faculty;
        $this->level = $level;
        $this->statuss = $statuss;
        $this->time = $time;
    }

    public function institution(): string
    {
        return $this->institution;
    }

    public function faculty(): ?string
    {
        return $this->faculty;
    }

    public function level(): ?string
    {
        return $this->level;
    }

    public function statuss(): string
    {
        return $this->statuss;
    }

    public function time(): string
    {
        return $this->time;
    }
}
