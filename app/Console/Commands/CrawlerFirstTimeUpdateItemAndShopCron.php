<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemJob;
use App\Jobs\CrawlerShopJob;
use Illuminate\Console\Command;

class CrawlerFirstTimeUpdateItemAndShopCron extends Command
{

    protected $signature = 'command:crawler_first_time_update_item_and_shop';


    protected $description = 'Command crawler_first_time_update_item_and_shop';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerItemJob())->onQueue('low'));
        dispatch((new CrawlerShopJob())->onQueue('low'));
    }
}
