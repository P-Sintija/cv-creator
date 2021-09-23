<?php

namespace App\Http\Controllers;

use App\Fields\AddressField;
use App\Fields\BasicDataField;
use App\Fields\Collections\FieldCollection;

use App\Fields\Collections\EducationFieldCollection;
use App\Fields\Collections\EmploymentFieldCollection;
use App\Fields\Collections\EmploymentDescriptionFieldCollection;
use App\Fields\EducationField;
use App\Fields\EmploymentField;
use App\Fields\EmploymentDescriptionField;
use App\Models\BasicData;
use App\Models\Education;
use App\Services\CreateService;
use App\Services\DeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    private DeleteService $deleteService;

    public function __construct(DeleteService $deleteService)
    {
        $this->deleteService = $deleteService;
    }

    public function destroy(Request $request): RedirectResponse
    {
        $this->deleteService->deleteCv((int)$request['id']);
        return redirect()->route('home.index');
    }

    public function destroyEducationEntity(Request $request): void
    {
        $this->deleteService->deleteEducadienEntity($request['educationId']);
    }

    public function destroyEmploymentEntity(Request $request): void
    {
        $this->deleteService->deleteEmploymentEntity($request['employmentId']);
    }
}