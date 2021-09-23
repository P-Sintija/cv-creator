<?php

namespace App\Services;

use App\Fields\AddressField;
use App\Fields\BasicDataField;
use App\Fields\EducationField;
use App\Fields\EmploymentField;
use App\Models\Address;
use App\Models\BasicData;
use App\Models\Education;
use App\Models\Employment;
use App\Models\EmploymentDescription;

class EditService
{
    public function updateBasicData(BasicDataField $basicDataField, string $userId): void
    {
        BasicData::where('user_Id', $userId)
            ->update([
                'name' => $basicDataField->name(),
                'surname' => $basicDataField->surname(),
                'phone' => $basicDataField->phone(),
                'email' => $basicDataField->email()
            ]);
    }

    public function updateAddress(AddressField $addressField, string $userId): void
    {
        Address::where('user_Id', $userId)
            ->update([
                'country' => $addressField->country(),
                'city' => $addressField->city(),
                'street' => $addressField->street(),
                'houseNumber' => $addressField->houseNumber(),
                'postIndex' => $addressField->postIndex()
            ]);
    }

    public function updateEducation(EducationField $educationField, int $educationId, string $userId): void
    {
        Education::updateOrCreate(
            ['id' => $educationId],
            [
                'user_Id' => $userId,
                'institution' => $educationField->institution(),
                'faculty' => $educationField->faculty(),
                'level' => $educationField->level(),
                'statuss' => $educationField->statuss(),
                'time' => $educationField->time()
            ]
        );
    }

    public function updateEmployment(EmploymentField $employmentField, int $employmentId, string $userId): void
    {
        Employment::updateOrCreate(
            ['id' => $employmentId],
            [
                'user_Id' => $userId,
                'institution' => $employmentField->institution(),
                'position' => $employmentField->position(),
                'time' => $employmentField->time()
            ]
        );

        if ($employmentId === 0) {
            $lastEntity = Employment::orderByDesc('id')->first();
            $employmentId = $lastEntity->id;
        }

        $this->updateEmploymentDescription($employmentField, $employmentId, $userId);
    }

    private function updateEmploymentDescription(EmploymentField $employmentField, int $employmentId, string $userId): void
    {
        EmploymentDescription::updateOrCreate(
            ['employment_Id' => $employmentId],
            [
                'user_Id' => $userId,
                'employment_Id' => $employmentId,
                'description' => $employmentField->description(),
                'achievements' => $employmentField->achievements(),
            ]
        );
    }
}
