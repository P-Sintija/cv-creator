<?php

namespace App\Http\Controllers;

use App\Services\DeleteService;
use Illuminate\Http\Request;
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

    public function destroyLanguageEntity(Request $request): void
    {
        $this->deleteService->deleteLanguageEntity($request['languageId']);
    }
}
