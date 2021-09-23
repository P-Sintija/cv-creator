<?php

namespace App\Http\Controllers\Edit;

use App\Http\Controllers\Controller;
use App\Fields\BasicDataField;
use App\Services\EditService;
use Illuminate\Http\Request;

class BasicDataController extends Controller
{
    private EditService $editService;

    public function __construct(EditService $editService)
    {
        $this->editService = $editService;
    }

    public function update(Request $request): void
    {
        $basicDataRequest = $request->basicData;
        $this->editService->updateBasicData(
            new BasicDataField(
                $basicDataRequest['name'],
                $basicDataRequest['surname'],
                $basicDataRequest['phone'],
                $basicDataRequest['email']
            ),
            $basicDataRequest['userId']
        );
    }
}
