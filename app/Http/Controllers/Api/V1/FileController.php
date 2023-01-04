<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use App\Services\FileService;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\VarDumper;

class FileController extends Controller
{
    public function __construct(
        private FolderService $_folderService,
        private FileService $_fileService,
    )
    {}

    /**
     * @throws \HttpException
     */
    public function uploadFile(FileUploadRequest $request, Folder $folder)
    {
        $file = $request->file('file');

        $path = $this->_fileService->configurePath($folder->name);
        // Сохранеям по пути "Диск/?директория?/название_файла"
        $file->storeAs($path, $file->getClientOriginalName() ,'local');

        //Берем сайз
        $imageSize = $file->getSize();

        // Валидация на размер диска
        if ($imageSize + $this->_folderService->getDiskSize() > User::MAX_SIZE_DISK) {
            throw new \HttpException("Пиздец, блять", 401);
        }

        File::create([
            'name' => $file->getClientOriginalName() . $file->getExtension(),
            'hash_name' => Hash::make($request->file('file')->getClientOriginalName()),
            'path' => $path,
            'size' => $imageSize,
            'folder_id' => is_null($folder) ? Auth::user()->id : $folder->id
        ]);

        return response(['message' => 'upload success!'], 200);
    }

    /**
     * @param Request $request
     * @param File $file
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function renameFile(Request $request, File $file)
    {
        return $this->_fileService->renameFile($file, $request);
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function removeFile(File $file)
    {
        Storage::disk('local')->delete($file->getFullPath());

        $file->delete();

        return response(['message' => 'success'], 204);

    }

    /**
     * @param File $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile(File $file)
    {
        return Storage::download($file->getFullPath());
    }

}
