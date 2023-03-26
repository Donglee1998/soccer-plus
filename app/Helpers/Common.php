<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

function get_file_version($file)
{
    if (file_exists(public_path($file))) {
        return "{$file}?v=" . date('YmdHis', filemtime(public_path($file)));
    }
    return "{$file}?v=" . date("Ymd");
}

function convert_public($public_state)
{
    return config('constants.setting_public.label.' . $public_state);
}

function format_date($date, $format = 'd-m-Y')
{
    return date($format, strtotime($date));
}

function un_format_zip($zip)
{
    if (preg_match("/^〒([0-9]{3}-[0-9]{4})$/", $zip)) {
        $zip = preg_replace('/[^0-9]/', '', $zip);
        if (strlen($zip) == 8) {
            $first = substr($zip, 0, 3);
            $last = substr($zip, 4, 7);
            $zip = $first . $last;
        }
    }
    return $zip;
}

function app_session($key)
{
    return new class($key)
    {
        private $_key;
        public function __construct($key)
        {
            $this->_key     = $key;
        }
        public function set($data)
        {
            session()->put($this->_key, $data);
        }
        public function get()
        {
            if ($this->_key) {
                $data = session()->get($this->_key);
                session()->forget($this->_key);
                return $data ? json_decode($data, true) : '';
            }
        }
    };
}

function change_expire_cookie_remember(int $minutes)
{
    $remember_token_name = \Auth::getRecallerName();
    $remember_cookie     = \Auth::getCookieJar()->queued($remember_token_name);
    if ($remember_cookie) {
        $cookie_value = $remember_cookie->getValue();
        \Cookie::queue($remember_token_name, $cookie_value, $minutes);
    }
}

function removeLastForwardSlash($string)
{
    return rtrim($string, '/');
}

function removeFirstForwardSlash($string)
{
    if (substr($string, 0, 1) == '/') {
        $string = substr_replace($string, '', 0, 1);
    }

    return $string;
}

function convertToKByte($bytes) {
    return ($bytes / 1024);
}

function delFileS3($arrayUrl)
{
    try {
        Storage::disk('s3')->delete($arrayUrl);
    } catch (\Exception $e) {

        return response()->json(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
    return true;
}

function reFormatDate($date)
{
    if(!empty($date)) {
        $pattern = '/\p{Han}+/u';

        return substr(preg_replace($pattern, '-', $date), 0, -1);
    }

    return null;
}

function parse_duration($seconds, $with_hour = true) {
    $hours  = $with_hour ? floor($seconds / 3600) : 0;
    $minutes = $with_hour ? floor(($seconds - ($hours * 3600)) / 60) : floor($seconds / 60);
    $second = $with_hour ? floor($seconds - ($hours * 3600) - ($minutes * 60)) : floor($seconds - ($minutes * 60));
    if ($minutes < 10) {
        $minutes = "0{$minutes}";
    }
    if ($second < 10) {
        $second = "0{$second}";
    }
    if ($hours < 10) {
        $hours = "0{$hours}";
    }
    if ($hours <= 0) {
        $hours = "00";
    }

    return $with_hour ? [(string)$hours,(string)$minutes, (string)$second] : [(string)$minutes, (string)$second];
}

function checkPasswordAdmin($user, $password_admin ='')
{
    $user = Auth::guard('web')->user();
    if(!empty($user)) {
        if ($password_admin && Hash::check($password_admin, $user->password_confirm)) {
            return response()->json([
                'message'   => 'auth success',
                'status'    => true
            ], JsonResponse::HTTP_OK);
        } else {

            return response()->json([
                'message'   => 'password error',
                'status'    => false
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }
    }

    return response()->json([
        'status' => false
    ], JsonResponse::HTTP_UNAUTHORIZED);
}

function move_file($old_path, $new_path)
{
    if (preg_match('/tmp\//', $old_path)) {
        $rename =  uniqid() . $old_path->getClientOriginalName();
        $new_path = $new_path . "/" . $rename;
        $path     = public_path($new_path);
        $is_exists = \File::exists($path);
        if (!$is_exists) {
            \Storage::disk('s3')->put($new_path, file_get_contents($old_path), 'public');
        }
        return $new_path;
    }
    return $old_path;
}

function time_to_sec($time)
{
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, (int)$k) * (int)$v;
    return $sec;
}

function zerofill($number, $width = 2)
{
    return str_pad((string) $number, $width, "0", STR_PAD_LEFT);
}

function get_action_name_by_id($id)
{
    if (empty(config('constants.dynamic_action'))) {
        $actions = [
            'label' => [],
            'key' => [],
        ];

        foreach (config('constants.action_map') as $name => $action) {
            $actions['label'][$action['id']] = $action['title'];
            $actions['key'][$name] = $action['id'];
        }

        config(['constants.dynamic_action' => $actions]);
    }

    return config("constants.dynamic_action.label.$id");
}

function is_anonymous_stat_belong_to_team($team_id, $team_home_id, $member_anonymous_id)
{
    if ($member_anonymous_id == -1 && $team_id == $team_home_id) {
        return true;
    } elseif ($member_anonymous_id == -2 && $team_id != $team_home_id) {
        return true;
    }
    return false;
}

function merge_zip($zip_1, $zip_2)
{
    return "$zip_1-$zip_2";
}

function create_id()
{
    return time().rand(1,1000);
}

function checkNumToDefaultColor($num, $color_team) {
    //Check color white, grey and num 0 to black
    if ($num == 0 || ($color_team == 1 || $color_team == 2 || $color_team == 3)) {
        return 'color:' . config('constants.team_color.4') . ' !important;';
    }
}

function get_input_encoding($file) {
    $fileContent = file_get_contents($file->path());
    $enc = mb_detect_encoding($fileContent, mb_list_encodings(), true);
    return $enc;
}

function get_action_result_label($action_id, $result)
{
    return config('constants.action_result.label.' . $result);
}

function get_display_number($match_type, $number_official, $number_practice)
{
    return $match_type == 1 ? $number_practice : $number_official;
}
