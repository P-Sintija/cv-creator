<?php

namespace App\Services;

use App\Models\Address;
use App\Models\BasicData;
use App\Models\Education;
use App\Models\Employment;
use App\Models\EmploymentDescription;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class ShowService
{
    private string $userId;

    public function basicData(int $id): BasicData
    {
        $basicData = BasicData::find($id);
        $this->setUserId($basicData);
        return $basicData;
    }

    public function address(): Address
    {
        return Address::where('user_Id', $this->userId)->first();
    }

    public function education(): Collection
    {
        return Education::where('user_Id', $this->userId)->get();
    }

    public function employment(): Collection
    {
        return Employment::where('user_Id', $this->userId)->get();
    }

    public function employmentDescription(): Collection
    {
        return EmploymentDescription::where('user_Id', $this->userId)->get();
    }

    public function language(): Collection
    {
        return Language::where('user_Id', $this->userId)->get();
    }

    private function setUserId(BasicData $basicData): void
    {
        $this->userId = $basicData->user_Id;
    }
}
