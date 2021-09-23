<?php

namespace App\Http\Controllers\Edit;

use App\Http\Controllers\Controller;
use App\Fields\EducationField;
use App\Services\EditService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    private EditService $editService;

    public function __construct(EditService $editService)
    {
        $this->editService = $editService;
    }

    public function update(Request $request): void
    {
        $educationRequest = $request->education;
        $educationField = new EducationField(
            $educationRequest['institution'],
            $educationRequest['faculty'],
            $educationRequest['level'],
            $educationRequest['statuss'],
            $educationRequest['time']
        );

        $this->editService->updateEducation(
            $educationField,
            (int)$educationRequest['educationId'],
            $educationRequest['userId']
        );
    }
}
