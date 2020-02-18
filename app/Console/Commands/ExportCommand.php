<?php

namespace App\Console\Commands;

use App\Jobs\ExportJob;
use Illuminate\Console\Command;

class ExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:pokemons';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        dispatch(new ExportJob());
    }
}
