<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\GeneralEmail;

class SyncronEveryMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syncron-every-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $notif = get_user_from_access('duty-roster.import');
        
        foreach($notif as $user){
            if($user->email){
                $message  = "<p>Dear {$user->name}<br />Please Check Duty Roster Site List</p>";
                $message .= "<p>This reminder automatics every month</p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
            }
        }

        return Command::SUCCESS;
    }
}
