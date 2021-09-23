<?php

namespace App\Fields;

class LanguageField implements Field
{
    private ?string $language;
    private ?string $level;

    public function __construct(
        ?string $language,
        ?string $level
    ) {
        $this->language = $language;
        $this->level = $level;
    }

    public function language(): ?string
    {
        return $this->language;
    }

    public function level(): ?string
    {
        return $this->level;
    }
}