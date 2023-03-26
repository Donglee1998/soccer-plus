<?php

namespace App\Http\Controllers\Web;

use App\Repositories\FolderRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Web\FolderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FolderController extends BaseController
{
    protected $__folderRepo;
    protected $__videoRepo;
    private $view = 'web.folder.';

    public function __construct(FolderRepository $folderRepo, VideoRepository $videoRepo)
    {
        $this->__folderRepo = $folderRepo;
        $this->__videoRepo  = $videoRepo;
    }

    public function list(Request $request)
    {
        $user                       = Auth::guard('web')->user();
        $conditions['created_by']   = $user->id;
        $columns                    = ['id', 'name'];
        $folders                    = $this->__folderRepo->list($conditions, $columns);

        return view($this->view . 'list', compact('folders'));
    }

    public function store(FolderRequest $request)
    {
        $user = Auth::guard('web')->user();
        $data = [
            'name'          => $request->name,
            'created_by'    => $user->id ?? '',
        ];
        $folder = $this->__folderRepo->create($data);

        return redirect()->route('web.team.album');
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('web')->user();

        $ischeck = checkPasswordAdmin($user, $request->password_admin);

        return $ischeck->status() === 200 ? $this->_detroyFolder($user, $request->id_folder) : $ischeck;
    }

    private function _detroyFolder($user, $id_folder = [])
    {
        try {
            $condition = [
                'created_by' => $user->id ?? '',
            ];
            if (!empty($id_folder)) {
                $condition['array_id_folder'] = array_map('intval', explode(",", $id_folder));
            }

            $this->__videoRepo->deleteVideoFollowFolder($condition);
            $this->__folderRepo->deleteFolder($condition);

            return response()->json([
                'message'   => 'Removed Folder Success.',
                'status'    => true
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listVideoOfFolder($folder_id)
    {
        $user       = Auth::guard('web')->user();
        $conditions = [
            'created_by' => $user->id,
            'folder_id'  => $folder_id ?? null
        ];

        $columns = ['videos.id', 'videos.title', 'videos.thumbnail', 'videos.path', 'videos.size', 'videos.folder_id'];
        $data = (object) [
            'videos' => $this->__videoRepo->list($conditions, $columns),
            'folder' => $this->__folderRepo->find($folder_id) ?? null,
            'space_upload_info' => $user->getSpaceUploadInfo(),
        ];
        return view($this->view . 'list-video', compact('data'));
    }

    public function update(FolderRequest $request, $folder_id)
    {
        try {
            $user       = Auth::guard('web')->user();
            $conditions = [
                'created_by' => $user->id,
                'folder_id'  => $folder_id ?? null,
            ];

            $builder = $this->__folderRepo->findFolder($conditions) ?? null;
            if (empty($builder)) {
                return $this->responseNotFound();
            }

            $data = [
                'name' => $request->name
            ];

            $this->__folderRepo->update($data, $folder_id);

            return response()->json([
                'message'   => 'Update Folder Success.',
                'status'    => true
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
