<?php

namespace App\Fields\Collections;

use App\Fields\Field;

class FieldCollection
{
    private array $fields;

    public function addField(Field $field): void
    {
        $this->fields[] = $field;
    }

    public function fields(): array
    {
        return $this->fields;
    }
}
