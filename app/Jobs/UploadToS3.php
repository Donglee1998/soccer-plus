<?php

namespace App\Jobs;

use FFMpeg\Filters\Frame\FrameFilters;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
use \FFMpeg;
use App\Http\Controllers\Web\UploaderController;

class UploadToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static $QUEUE = "upload_to_s3";
    private $file_path;
    private $file_name;
    private $storage_path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path, $file_name, $storage_path)
    {
        $this->file_path = $file_path;
        $this->file_name = $file_name;
        $this->storage_path = $storage_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $upload_dir = 'video/';
        Storage::disk('s3')->putFileAs($upload_dir, new File($this->file_path), $this->file_name);
        FFMpeg::fromDisk('local')
            ->open($this->storage_path)
            ->getFrameFromSeconds(3)
            ->export()
            ->addFilter(function (FrameFilters $filters) {
                $filters->custom('scale=120:80');
            })
            ->toDisk('s3')
            ->save(UploaderController::getVideoThumbailPath($this->file_name));
    }
}
