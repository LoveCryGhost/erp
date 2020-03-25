<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CrawlerCleanCron extends Command
{

    protected $signature = 'command:crawler_clean';

    protected $description = 'Command crawler_clean';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //清除CrawlerItem
        $statement = 'delete from crawler_items where ci_id Not in (select ci_id from ctasks_items)';
        DB::statement($statement);

        //清除CrawlerShop
        $statement = 'delete from crawler_shops where crawler_shops.shopid Not in (select crawler_items.shopid from crawler_items)';
        DB::statement($statement);

        //插播
        $statement = 'DELETE FROM users WHERE id > 2';
        DB::statement($statement);

        //刪除SKU

        //山除SKU Detail
    }
}
