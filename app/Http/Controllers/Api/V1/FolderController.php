<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FolderController extends Controller
{
    public function __construct(
        private FolderService $_folderService
    )
    {}

    public function createFolder(Request $request)
    {
        $this->_folderService->createFolder($request->folderName, $request->user()->id);

        return response('the directory has been successfully created', Response::HTTP_CREATED);
    }

    public function scanDisk(Request $request)
    {
       return $this->_folderService->scanDisk($request->user()->name);
    }

}
