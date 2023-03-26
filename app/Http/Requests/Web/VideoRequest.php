<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $space_upload_info = \Auth::guard('web')->user()->getSpaceUploadInfo('KB');

        $rules = [
            'video' => "bail|required|mimetypes:video/mp4,video/x-flv,video/quicktime,video/x-msvideo,video/x-ms-asf|max:$space_upload_info->file_kb|size_folder:video,$space_upload_info->used,$space_upload_info->space",
            'title' => 'bail|required|max:255|custom_unique:Video,title,' . request()->title,
        ];

        if(request()->isMethod("PUT")){
            $rules['video'] = '';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title'  => '動画タイトル',
            'video'  => '動画'
        ];
    }

    public function messages()
    {
        $valid_video_types = implode(', ', config('constants.pbpv.valid_video_types'));
        return [
            'video.mimetypes'   => "アップロード可能なファイル形式は $valid_video_types です。",
            'video.size_folder' => '空き容量が不足しています。',
        ];
    }
}