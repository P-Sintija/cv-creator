<?php

namespace App\Services;

use App\Fields\AddressField;
use App\Fields\BasicDataField;
use App\Fields\Collections\FieldCollection;
use App\Fields\EducationField;
use App\Fields\EmploymentField;
use App\Fields\LanguageField;
use App\Models\Address;
use App\Models\BasicData;
use App\Models\Education;
use App\Models\Employment;
use App\Models\EmploymentDescription;
use App\Models\Language;

class CreateService
{
    public function store(FieldCollection $fieldCollection): void
    {
        $userId = uniqid();

        foreach ($fieldCollection->fields() as $field) {
            if ($field instanceof BasicDataField) {
                $this->basicData($field, $userId);
            } else if ($field instanceof AddressField) {
                $this->address($field, $userId);
            } else if ($field instanceof EducationField) {
                $this->education($field, $userId);
            } else if ($field instanceof EmploymentField) {
                $this->employment($field, $userId);
            } else if ($field instanceof LanguageField) {
                $this->language($field, $userId);
            }
        }
    }

    private function basicData(BasicDataField $basicDataField, string $userId): void
    {
        $basicData = new BasicData;
        $basicData->user_Id = $userId;
        $basicData->name = $basicDataField->name();
        $basicData->surname = $basicDataField->surname();
        $basicData->phone = $basicDataField->phone();
        $basicData->email = $basicDataField->email();
        $basicData->save();
    }

    private function address(AddressField $addressField, string $userId): void
    {
        $address = new Address;
        $address->user_Id = $userId;
        $address->country = $addressField->country();
        $address->city = $addressField->city();
        $address->street = $addressField->street();
        $address->houseNumber = $addressField->houseNumber();
        $address->postIndex = $addressField->postIndex();
        $address->save();
    }

    private function education(EducationField $educationField, string $userId): void
    {
        $education = new Education;
        $education->user_Id = $userId;
        $education->institution = $educationField->institution();
        $education->faculty = $educationField->faculty();
        $education->level = $educationField->level();
        $education->statuss = $educationField->statuss();
        $education->time = $educationField->time();
        $education->save();
    }

    private function employment(EmploymentField $employmentField, string $userId): void
    {
        $employment = new Employment;
        $employment->user_Id = $userId;
        $employment->institution = $employmentField->institution();
        $employment->position = $employmentField->position();
        $employment->time = $employmentField->time();
        $employment->save();

        $this->employmentDescription($employmentField, $employment);
    }

    private function employmentDescription(EmploymentField $employmentField, Employment $employment): void
    {
        $employmentDescription = new EmploymentDescription;
        $employmentDescription->user_Id = $employment->user_Id;
        $employmentDescription->employment_Id = $employment->id;
        $employmentDescription->description = $employmentField->description();
        $employmentDescription->achievements = $employmentField->achievements();
        $employmentDescription->save();
    }

    private function language(LanguageField $languageField, string $userId): void
    {
        $language = new Language;
        $language->user_Id = $userId;
        $language->language = $languageField->language();
        $language->level = $languageField->level();
        $language->save();
    }
}
