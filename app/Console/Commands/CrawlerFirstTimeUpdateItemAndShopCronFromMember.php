<?php

namespace App\Console\Commands;

use App\Jobs\CrawlerItemJob;
use App\Jobs\CrawlerShopJob;
use Illuminate\Console\Command;

class CrawlerFirstTimeUpdateItemAndShopCronFromMember extends Command
{

    protected $signature = 'command:crawler_first_time_update_item_and_shop_fromCategory';
    protected $description = 'Command crawler_first_time_update_item_and_shop_fromCategory';


    public function __construct()
    {
        parent::__construct();
    }


    //EveryMintu
    public function handle()
    {
        dispatch((new CrawlerItemFromMemberJob())->onQueue('high'));
        dispatch((new CrawlerShopFromMemberJob())->onQueue('high'));
    }
}
