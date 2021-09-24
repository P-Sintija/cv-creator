<?php

namespace App\Http\Controllers\Edit;

use App\Http\Controllers\Controller;
use App\Fields\LanguageField;
use App\Services\EditService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private EditService $editService;

    public function __construct(EditService $editService)
    {
        $this->editService = $editService;
    }

    public function update(Request $request): void
    {
        $languageRequest = $request->language;
        $languageField = new LanguageField(
            $languageRequest['language'],
            $languageRequest['level']
        );

        $this->editService->updateLanguage(
            $languageField,
            (int) $languageRequest['languageId'],
            $languageRequest['userId']
        );
    }
}
