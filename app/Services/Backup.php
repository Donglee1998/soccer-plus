<?php
namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use App\Models\Backup as BackupModel;
use Exception;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Backup
{
    protected $file;
    protected $client;
    protected $folder;

    public function __construct()
    {
        $this->file = new Filesystem();
        $this->client = S3Client::factory(array(
            'key'     => env('AWS_ACCESS_KEY_ID'),
            'secret'  => env('AWS_SECRET_ACCESS_KEY'),
            'version' => 'latest',
            'region'  => 'ap-northeast-1'
        ));
    }

    /**
     * get list backup
     * @return array
     */
    public function getBackupList()
    {
        $columns = ['id', 'name', 'comment', 'size', 'created_at'];
        $backups = BackupModel::select($columns)->where('user_id', auth('api')->user()->id)->get();
        return $backups;
    }

    /**
     * get create folder backups
     * @return string
     */
    public function createBackupFolder()
    {
        $this->createFolder(storage_path('backups'));
        $this->folder = time().rand();
        $this->createFolder(storage_path('backups') . DIRECTORY_SEPARATOR . $this->folder);
        return $this->folder;
    }

    /**
     * export DB and save file to S3
     */
    public function backupDb($datas)
    {
        $path = storage_path('backups') . DIRECTORY_SEPARATOR . $this->folder .'/';
        try{
            $tables = [
                'teams', 
                'members',
                'lineups',
                'matches',
                'tactics',
                'sheets',
                'stats'
            ];
            foreach ($tables as $table) {
                Storage::disk('backups')->put($this->folder .'/'. $table.'.json', json_encode($datas[$table]));
            }

            $this->client->uploadDirectory($path, env('AWS_BUCKET'), 'backups/' . $this->folder);
        }
        catch (S3Exception $e) {
            report($e);
        }
    }

    /**
     * get file from s3
     * @param folder string
     * @return
     */
    public function restoreDb($data)
    {
        $tables = [
            'teams', 
            'members',
            'lineups',
            'matches',
            'tactics',
            'sheets',
            'stats'
        ];
        $user_id = auth('api')->user()->id;
        $data_restore = [];
        foreach ($tables as $table) {
            $result = $this->client->getObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => 'backups/' . $data->name . '/'. $table . '.json'
            ]);
            header("Content-Type: {$result['ContentType']}");
            $data_restore[$table] = $result['Body'] ? json_decode ($result['Body'], true) : [];
        }
        $data_restore['stats'] = $this->convertStat($data_restore);
        return $data_restore;
    }

    /**
     * delete folder
     * @param folder string
     * @return
     */
    public function deleteBackup($folder)
    {
        $this->file->deleteDirectory(config('backup.file.storage') . $folder);
        Storage::disk('s3')->deleteDirectory('backups/' . $folder);
    }

    /**
     * create folder
     * @param folder string
     * @return string
     */
    public function createFolder($folder)
    {
        if (!$this->file->isDirectory($folder)) {
            $this->file->makeDirectory($folder);
            chmod($folder, 0777);
        }
        return $folder;
    }

     /**
     * get folder size
     * @param dir string
     * @return string
     */
    public static function folderSize($dir)
    {
        $size = 0;

        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : static::folderSize($each);
        }

        return ($size);
    }

    /**
     * get size folder
     * @param bytes string
     * @return string
     */
    public static function sizeFormat($bytes, $precision = 2)
    {
        $base     = log($bytes, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    /**
     * convert data stat
     * @param data array
     * @return array
     */
    public static function convertStat($data)
    {
        $match_ids = data_get($data['matches'], '*.id');
        $stats = $data['stats'];
        foreach ($data['stats'] as $key => $stat) {
            if(!in_array($stat['match_id'], $match_ids)) {
                unset($stats[$key]);
            }
        }
        return $stats;
    }

}
