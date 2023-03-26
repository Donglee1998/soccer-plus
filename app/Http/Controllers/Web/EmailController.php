<?php

namespace App\Http\Controllers\Web;

use Mail;

class EmailController extends BaseController
{

    public static function sendContactInfoToAdmin($created_record)
    {
        $template = '/web/mail/contact/admin';
        $from     = config('mail.from.address');
        $to       = config('mail.admin.address');
        $subject  = 'Soccer Pad：お問い合わせがありました';
        $data     = [
            'url'     => route('admin.contact.edit', $created_record->id),
            'contact' => $created_record,
        ];

        self::_send($template, $data, $to, $from, $subject);
    }

    public static function sendContactInfoToUser($created_record)
    {
        $template = '/web/mail/contact/user';
        $from     = config('mail.from.address');
        $to       = $created_record->email;
        $subject  = 'Soccer Pad：お問い合わせを受け付けました';
        $data     = [
            'contact' => $created_record,
        ];

        self::_send($template, $data, $to, $from, $subject);
    }

    public static function sendEntryInfoToAdmin($created_record)
    {
        $template = '/web/mail/entry/admin';
        $from     = config('mail.from.address');
        $to       = config('mail.admin.address');
        $subject  = 'Soccer Pad：プレミアムチームの申込がありました';
        $data     = [
            'url'   => route('admin.registration.edit', $created_record->id),
            'entry' => $created_record,
        ];

        self::_send($template, $data, $to, $from, $subject);
    }

    public static function sendEntryInfoToUser($created_record)
    {
        $template = '/web/mail/entry/user';
        $from     = config('mail.from.address');
        $subject  = 'Soccer Pad：プレミアムチームのお申し込みありがとうございます。';
        $data     = [
            'entry' => $created_record,
        ];

        self::_send($template, $data, $to = $created_record->registration_email, $from, $subject);
        self::_send($template, $data, $to = $created_record->pic_email, $from, $subject);
    }

    public static function sendContactAlertToAdmin($error, $session_data)
    {
        $template = '/web/mail/contact/alert';
        $from     = config('mail.from.address');
        $to       = config('mail.admin.address');
        $subject  = '【アラートメール】データベースへの保存に失敗しました';
        $message  = $error->getMessage();
        $line     = $error->getLine();
        $file     = $error->getFile();
        $trace    = $error->getTraceAsString();
        $data     = [
            'table'         => 'contacts',
            'url'           => route('web.contact.create'),
            'error_message' => "[ERROR] File: $file, line: $line\nMessage: $message",
            'session_data'  => $session_data,
        ];

        self::_send($template, $data, $to, $from, $subject);
    }

    public static function sendEntryAlertToAdmin($error, $session_data)
    {
        $template = '/web/mail/entry/alert';
        $from     = config('mail.from.address');
        $to       = config('mail.admin.address');
        $subject  = '【アラートメール】データベースへの保存に失敗しました';
        $message  = $error->getMessage();
        $line     = $error->getLine();
        $file     = $error->getFile();
        $trace    = $error->getTraceAsString();
        $data     = [
            'table'         => 'registrations',
            'url'           => route('web.entry.index'),
            'error_message' => "[ERROR] File: $file, line: $line\nMessage: $message",
            'session_data'  => $session_data,
        ];

        self::_send($template, $data, $to, $from, $subject);
    }

    private static function _send($template, $data, $to, $from, $subject)
    {
        Mail::send(["text" => $template], $data, function ($message) use ($to, $from, $subject) {
            $message->subject($subject);
            $message->from($from);
            $message->to($to);
        });
    }
}
