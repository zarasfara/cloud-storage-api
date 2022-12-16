<?php

namespace App\Http\Controllers;

use App\Services\FolderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FolderController extends Controller
{
    public function __construct(private FolderService $_folderService)
    {

    }

    public function createFolder(Request $request)
    {
        $this->_folderService->createFolder($request->folderName);

        return response('the directory has been successfully created', Response::HTTP_CREATED);
    }
}
