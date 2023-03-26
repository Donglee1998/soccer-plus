<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Models\Team;
use App\Models\Member;
use App\Models\Tournament;
use App\Models\Lineup;
use App\Models\Tactic;
use App\Models\Video;
use DB;

class ChangeDataFromLoginToRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-data-from-login-to-register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ChangeDataFromLoginToRegister';

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
        $logins         = DB::table('logins')->whereNotNull('registration_id')->whereIn('level', ['1', 1])->get();

        foreach ($logins as $login) {
            Registration::where('id', $login->registration_id)->update([
                'email'               => $login->email ?? '',
                'username'            => $login->username ?? '',
                'password'            => $login->password ?? '',
                'password_confirm'    => $login->password_admin ?? ''
            ]);

            Team::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);

            Member::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);

            Tournament::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);

            Lineup::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);

            Tactic::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);

            Video::where('created_by', $login->id)->update([
                'created_by' => $login->registration_id,
            ]);
        }
    }
}
