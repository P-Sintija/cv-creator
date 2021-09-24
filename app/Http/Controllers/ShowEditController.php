<?php

namespace App\Http\Controllers;

use App\Services\ShowService;
use Illuminate\View\View;

class ShowEditController extends Controller
{
    private ShowService $service;

    public function __construct(ShowService $service)
    {
        $this->service = $service;
    }

    public function show(int $id): View
    {
        $basicData = $this->service->basicData($id);

        return view('edit', [
            'basicData' => $basicData,
            'address' => $this->service->address(),
            'education' => $this->service->education(),
            'employment' => $this->service->employment(),
            'employmentDescription' => $this->service->employmentDescription(),
            'language' => $this->service->language()
        ]);
    }
}
