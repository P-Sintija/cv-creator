<?php

namespace App\Services;

use App\Models\Address;
use App\Models\BasicData;
use App\Models\Education;
use App\Models\Employment;
use App\Models\EmploymentDescription;
use App\Models\Language;

class DeleteService
{
    public function deleteCV(int $id): void
    {
        $basicData = BasicData::find($id);
        $userId = $basicData->user_Id;

        $basicData->delete();
        $this->address($userId);
        $this->education($userId);
        $this->employment($userId);
    }

    public function deleteEducadienEntity(int $educationId): void
    {
        $education = Education::find($educationId);
        $education->delete();
    }

    public function deleteEmploymentEntity(int $employmentId): void
    {
        $employment = Employment::find($employmentId);
        $employment->delete();
        $employmentDescription = EmploymentDescription::where('employment_Id', $employmentId)->first();
        $employmentDescription->delete();
    }

    public function deleteLanguageEntity(int $languageId): void
    {
        $language = Language::find($languageId);
        $language->delete();
    }

    private function address(string $userId): void
    {
        $address = Address::where('user_Id', $userId)->first();
        $address->delete();
    }

    private function education(string $userId): void
    {
        $educations = Education::where('user_Id', $userId)->get();
        foreach ($educations as $education) {
            $education->delete();
        }
    }

    private function employment(string $userId): void
    {
        $employments = Employment::where('user_Id', $userId)->get();
        foreach ($employments as $employment) {
            $employment->delete();
        }

        $this->employmentDescription($userId);
    }

    private function employmentDescription(string $userId): void
    {
        $employments = EmploymentDescription::where('user_Id', $userId)->get();
        foreach ($employments as $employment) {
            $employment->delete();
        }
    }
}
