<?php

namespace App\Http\Controllers;

use App\Services\VerseService;
use Illuminate\Http\Request;

class VersesController extends Controller
{
    private $verseService;

    public function __construct(
        VerseService $verseService,
    ) {
        $this->verseService = $verseService;
    }

    public function index(Request $request)
    {
        $validated = [
            'bookRef' => $request->bookRef,
            'chapter' => $request->chapter ?? 1,
            'verse' => $request->verse,
            'version' => $request->version
        ];

        return $this->verseService->getVerses($validated);
    }    
    
}
