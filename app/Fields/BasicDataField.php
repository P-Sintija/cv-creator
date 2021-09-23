<?php

namespace App\Fields;

class BasicDataField implements Field
{
    private string $name;
    private string $surname;
    private ?string $phone;
    private string $email;

    public function __construct(
        string $name,
        string $surname,
        ?string $phone,
        string $email
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function email(): string
    {
        return $this->email;
    }
}
