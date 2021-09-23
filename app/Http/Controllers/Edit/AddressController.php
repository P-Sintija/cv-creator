<?php

namespace App\Http\Controllers\Edit;

use App\Http\Controllers\Controller;
use App\Fields\AddressField;
use App\Services\EditService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private EditService $editService;

    public function __construct(EditService $editService)
    {
        $this->editService = $editService;
    }

    public function update(Request $request): void
    {
        $addressRequest = $request->address;
        $this->editService->updateAddress(
            new AddressField(
                $addressRequest['country'],
                $addressRequest['city'],
                $addressRequest['street'],
                $addressRequest['houseNumber'],
                $addressRequest['postIndex']
            ),
            $addressRequest['userId']
        );
    }
}
