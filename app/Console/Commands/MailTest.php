<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class MailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {--to=} {--subject=} {--body=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing email sending';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $from    = config('mail.from.address');
            $to      = $this->option("to") ?? 'hudson@cybridge.jp';
            $subject = $this->option("subject") ?? 'This is email subject';
            $body    = $this->option("body") ?? 'This is email body';

            $data = ["body" => $body];

            Mail::send(["text" => "/web/mail/test"], $data, function ($message) use ($to, $from, $subject) {
                $message->subject($subject);
                $message->from($from);
                $message->to($to);
            });

            return 0;
        } catch (\Throwable $th) {
            print_r("\nLine: " . $th->getLine() . "\n");
            print_r($th->getMessage() . "\n");
        }
    }
}
