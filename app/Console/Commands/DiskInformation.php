<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiskInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disk-information';

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
        foreach(\App\Models\Employee::where('nik',1111)->get() as $em){

            exec('df -h', $usage);
            $msg = "\n*Disk Information* :  \n";
            foreach($usage as $val){
                $msg .= $val."\n";
            }

            exec('du -sh /var/www/*', $erp_storage);
            $msg .= "\n*Storage Web* \n";
            foreach($erp_storage as $val){
                $msg .= $val."\n";
            }

            $msg .= "\n*Total Backup* : ";
            exec('du -sh /home/backup', $total_backup);
            foreach($total_backup as $val){
                $msg .= $val ."\n";
            }

            exec('du -sh /home/backup/*', $backup);
            $msg .="*Backup Item*\n";
            foreach($backup as $val){
                $msg .= $val."\n";
            }

            send_wa(['phone'=>'087775365856','message'=> $msg]);
            send_wa(['phone'=>'081289992707','message'=> $msg]);
        }
    }
}
