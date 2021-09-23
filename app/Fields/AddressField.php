<?php

namespace App\Fields;

class AddressField implements Field
{
    private string $country;
    private string $city;
    private ?string $street;
    private ?string $houseNumber;
    private ?string $postIndex;

    public function __construct(
        string $country,
        string $city,
        ?string $street,
        ?string $houseNumber,
        ?string $postIndex
    ) {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->postIndex = $postIndex;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function street(): ?string
    {
        return $this->street;
    }

    public function houseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function postIndex(): ?string
    {
        return $this->postIndex;
    }
}
