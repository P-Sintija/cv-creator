<?php

namespace App\Http\Controllers;

use App\Services\ListService;
use Illuminate\View\View;

class HomeController extends Controller
{
    private ListService $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }
    public function index(): View
    {
        $list = $this->listService->getList();
        return view('list', ['list' => $list]);
    }
}
