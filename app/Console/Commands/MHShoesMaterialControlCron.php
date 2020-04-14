<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerShopJob;
use App\Jobs\CrawlerTaskJob;
use App\Jobs\MHShoesMaterialControlJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MHShoesMaterialControlCron extends Command
{

    protected $signature = 'command:mh_shoes_material_control';


    protected $description = 'Command mh_shoes_material_control';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new MHShoesMaterialControlJob())->onQueue('high'));
    }
}
