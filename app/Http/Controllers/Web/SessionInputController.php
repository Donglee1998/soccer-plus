<?php

namespace App\Http\Controllers\Web;

use App\Models\SessionInput;

class SessionInputController extends BaseController
{

    public static function getNotSubmittedData($page, $default = [])
    {
        $session_input = SessionInput::where('session_id', session()->getId())
            ->where('page', $page)
            ->whereNull('submitted_at')->first();
        if (empty($session_input) || empty($session_input->data)) {
            return $default;
        }
        return json_decode($session_input->data, true);
    }

    public static function saveNotSubmittedData($page, $data = [])
    {
        $basic_conditions = [
            'session_id' => session()->getId(),
            'page'       => $page,
        ];

        SessionInput::updateOrCreate($basic_conditions, array_merge($basic_conditions, [
            'data'         => json_encode($data),
            'submitted_at' => null,
        ]));
    }

    public static function markSubmittedData($page)
    {
        if ($session_input = SessionInput::where('session_id', session()->getId())
            ->where('page', $page)->first()) {
            $session_input->update([
                'submitted_at' => now(),
            ]);
            $session_input->delete();
        }
    }
}
