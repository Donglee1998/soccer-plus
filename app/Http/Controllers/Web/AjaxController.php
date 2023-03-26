<?php

namespace App\Http\Controllers\Web;

use App\Repositories\FolderRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Web\FolderRequest;
use App\Http\Requests\Web\VideoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;

class AjaxController extends BaseController
{
    protected $__folderRepo;
    protected $__videoRepo;

    public function __construct(FolderRepository $folderRepo, VideoRepository $videoRepo)
    {
        $this->__folderRepo = $folderRepo;
        $this->__videoRepo  = $videoRepo;
    }

    public function listFolder(Request $request)
    {
        $user                     = Auth::guard('web')->user();
        $conditions['created_by'] = $user->id;
        $columns                  = ['id', 'name'];
        $folders                  = $this->__folderRepo->list($conditions, $columns);

        return $folders;
    }

    public function storeFolder(FolderRequest $request)
    {
        $user = Auth::guard('web')->user();
        $data = [
            'name'       => $request->name,
            'created_by' => $user->id ?? '',
        ];
        $folder = $this->__folderRepo->create($data);

        return response()->json([
            'message' => 'Created Folder Success.',
            'folder'  => $folder
        ], JsonResponse::HTTP_OK);
    }

    public function listVideo(Request $request)
    {
        $user       = Auth::guard('web')->user();
        $conditions = [
            'created_by'    => $user->id,
            'folder_id'     => $request->folder_id ?? null,
            'is_pagination' => false,
        ];

        $columns        = ['videos.id', 'videos.title', 'videos.thumbnail', 'videos.path', 'videos.size'];
        $videos         = $this->__videoRepo->list($conditions, $columns);

        return $videos;
    }
}
