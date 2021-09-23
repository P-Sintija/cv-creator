<?php

namespace App\Http\Controllers;


use App\Services\CreateService;
use App\Services\ProcessRequestService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateController extends Controller
{
    private ProcessRequestService $processRequestService;
    private CreateService $createService;

    public function __construct(
        CreateService $createService,
        ProcessRequestService $processRequestService
    ) {
        $this->processRequestService = $processRequestService;
        $this->createService = $createService;
    }

    public function index(): View
    {
        return view('createForm');
    }

    public function store(Request $request)
    {
        $this->createService->store($this->processRequestService->processRequest($request->all()));
    }
}
