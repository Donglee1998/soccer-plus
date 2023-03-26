<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\BeforeChunkVideoAlbumRequest;
use App\Http\Requests\Web\BeforeChunkVideoPlayRequest;
use App\Jobs\UploadToS3;
use App\Models\FailedJob;
use App\Models\Job;
use App\Models\Video;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploaderController extends BaseController
{
    public static function getVideoThumbailPath($video_name)
    {
        $thumb_name = "$video_name.thumb.png";
        return "images/$thumb_name";
    }

    public function albumValidate(BeforeChunkVideoAlbumRequest $request)
    {
        return response()->json([]);
    }

    public function playValidate(BeforeChunkVideoPlayRequest $request)
    {
        return response()->json([]);
    }

    public function albumSave(Request $request)
    {
        set_time_limit(0);
        \DB::beginTransaction();
        try {
            $user        = Auth::guard('web')->user();
            $file_path   = $this->getFinalPath($request->path . $request->name);
            $file_name   = $request->name;
            $upload_dir  = 'video/';
            $upload_path = $upload_dir . $file_name;
            $video_info  = (new \getID3)->analyze($file_path);

            $video = [
                'title'      => $request->title ?? '',
                'path'       => $upload_path,
                'size'       => number_format($video_info['filesize'] / 1024, 2, '.', ''),
                'duration'   => floor($video_info['playtime_seconds']),
                'folder_id'  => $request->folder_id ?? null,
                'created_by' => $user->id ?? '',
                'thumbnail'  => self::getVideoThumbailPath($file_name),
            ];

            Video::create($video);
            unlink($file_path);
            \DB::commit();
            return response()->json([]);
        } catch (\Throwable $th) {
            \DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function upload(Request $request)
    {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile());
        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done"   => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }

    public function progress(Request $request)
    {
        $job = Job::find($request->job_id);
        if ($job) {
            return response()->json([
                "status"  => "processing",
                "message" => "",
            ]);
        }

        return response()->json([
            "status"  => "done",
            "message" => "",
        ]);
    }

    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function saveFile(UploadedFile $file)
    {
        set_time_limit(0);
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-d");
        // Build the file path
        $filePath  = "upload/{$mime}/{$dateFolder}/";
        $finalPath = $this->getFinalPath($filePath);
        $storagePath = $filePath . $fileName;
        // move the file name
        $file->move($finalPath, $fileName);

        $job = (new UploadToS3($this->getFinalPath($storagePath), $fileName, $storagePath))
            ->onConnection('database')
            ->onQueue(UploadToS3::$QUEUE);
        $job_id = config('constants.queue_now')
            ? app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatchNow($job)
            : app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($job);

        return response()->json([
            'path'      => $filePath,
            'name'      => $fileName,
            'mime_type' => $mime,
            'job_id'    => $job_id,
        ]);
    }

    protected function getFinalPath($filePath)
    {
        return storage_path("app/$filePath");
    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension
        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;
        return $filename;
    }
}
