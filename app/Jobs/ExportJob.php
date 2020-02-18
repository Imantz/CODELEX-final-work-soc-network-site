<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * @var int
     */
    private $countUntil;

    public function __construct()
    {
    }

    public function handle()
    {
        $fp = fopen('file.csv', 'w');

        $users = DB::table("users")
            ->select("name", "surname")
            ->get();

                foreach ($users as $user)
        {
            fwrite($fp, implode(",",get_object_vars($user)). " \n");
        }
    }
}
