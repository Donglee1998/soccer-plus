<?php

namespace App\Http\Controllers\Api;

use App\Services\Backup;
use Exception;
use Illuminate\Http\Request;
use App\Models\Backup as BackupModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;

class BackupController extends Controller
{
    protected $backup;
    public function __construct(Backup $backup)
    {
        $this->backup = $backup;
    }

    /**
     * Backup list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $backups = $this->backup->getBackupList();
        return $this->response($backups);
    }

    /**
     * Backup DB
     * @param request object
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $condition = [
                'comment' => $request->comment
            ];
            $validate = $this->validateRequest($condition, [
                'comment' => ['required'],
            ]);
            if (!$validate) {
                return $this->responseNotFound();
            }

            $folder = $this->backup->createBackupFolder();
            $this->backup->backupDb($request->all());

            $data = [
                'name'    => $folder,
                'user_id' => auth('api')->user()->id,
                'comment' => $request->comment,
                'size'    => $this->backup->sizeFormat(Backup::folderSize(config('backup.file.storage') . $folder))
            ];
            BackupModel::create($data);

            $file = new Filesystem();
            $file->deleteDirectory(config('backup.file.storage') . $folder);

            return $this->response($data);
        } catch (Exception $error) {
            report($error);
            return $this->responseFailure($error);
        }
    }

    /**
     * Import DB
     * @param id integer
     * @return boolean
     */
    public function restore(Request $request, $id)
    {
        try {
            $data = BackupModel::where('user_id', auth()->user()->id)->find($id);
            if (!$data) {
                return $this->responseNotFound();
            }
            $result = $this->backup->restoreDb($data);
            return $this->response($result);
        } catch (Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }

    /**
     * Delete backup
     * @param id integer
     * @return boolean
     */
    public function delete(Request $request, $id)
    {
        try {
            $file = BackupModel::where('user_id', auth()->user()->id)->find($id);
            if (!$file) {
                return $this->responseNotFound();
            }
            $file->delete();
            $this->backup->deleteBackup($file->name);
            return $this->response(true);
        } catch (Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }

    /**
     * Delete multiple backup
     * @param request object
     * @return boolean
     */
    public function multiDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->ids as $id) {
                $file = BackupModel::where('user_id', auth()->user()->id)->find($id);
                if ($file) {
                    $file->delete();
                    $this->backup->deleteBackup($file->name);
                }
            }
            DB::commit();
            return $this->response(true);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->responseFailure($e);
        }
    }
}
