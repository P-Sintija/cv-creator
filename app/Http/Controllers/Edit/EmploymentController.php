<?php

namespace App\Http\Controllers\Edit;

use App\Http\Controllers\Controller;
use App\Fields\EmploymentField;
use App\Services\EditService;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    private EditService $editService;

    public function __construct(EditService $editService)
    {
        $this->editService = $editService;
    }

    public function update(Request $request): void
    {
        $employmentRequest = $request->employment;
        $employmentField = new EmploymentField(
            $employmentRequest['institution'],
            $employmentRequest['position'],
            $employmentRequest['time'],
            $employmentRequest['description'],
            $employmentRequest['achievements']
        );

        $this->editService->updateEmployment(
            $employmentField,
            (int)$employmentRequest['employmentId'],
            $employmentRequest['userId']
        );
    }
}
