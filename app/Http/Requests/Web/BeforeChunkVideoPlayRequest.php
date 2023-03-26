<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BeforeChunkVideoPlayRequest extends FormRequest
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
        $left_byte         = intval(($space_upload_info->space - $space_upload_info->used) * 1024);
        $left_byte         = $left_byte < 0 ? 0 : $left_byte;

        $rules = [
            'title' => 'bail|required|max:255|custom_unique:Video,title,' . request()->title,
            'size'  => "bail|required|numeric|max:$left_byte",
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => '動画タイトル',
            'video' => '動画',
            'size'  => '動画',
        ];
    }

    public function messages()
    {
        return [
            'title.*'         => '動画タイトルが無効です。',
            'video.mimetypes' => 'アップロード可能なファイル形式は mp4, avi, flv, mov, wmv です。',
            '*.size_folder'   => '空き容量が不足しています。',
            'size.max'        => '空き容量が不足しています。',
        ];
    }

    public function failedValidation(ValidatorContract $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        foreach ($errors as $key => $value) {
            $errors[$key] = reset($value);
        }
        throw new HttpResponseException(response()->json($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
