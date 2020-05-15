<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerCategoryJob;
use Illuminate\Console\Command;

class CrawlerCategoryCron extends Command
{

    protected $signature = 'command:crawler_category';


    protected $description = 'Command crawler_category';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerCategoryJob())->onQueue('high'));
    }
}
