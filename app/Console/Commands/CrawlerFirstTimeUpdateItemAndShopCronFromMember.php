<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemFromMemberJob;
use App\Jobs\CrawlerShopJob;
use Illuminate\Console\Command;

class CrawlerFirstTimeUpdateItemAndShopCronFromMember extends Command
{

    protected $signature = 'command:crawler_first_time_update_item_and_shop_fromMember';
    protected $description = 'Command crawler_first_time_update_item_and_shop_fromMember';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerItemFromMemberJob())->onQueue('high'));
        dispatch((new CrawlerShopJob())->onQueue('high'));
    }
}
