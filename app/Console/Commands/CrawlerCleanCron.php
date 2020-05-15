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
        'SELECT v.VID, v.thumb FROM video AS v
            INNER JOIN (SELECT VID FROM video WHERE title LIKE "%'.$Channel['name'].'%" ORDER BY viewtime DESC LIMIT 5) as v2 ON v.VID = v2.VID ORDER BY RAND()LIMIT 1';
//        'SELECT VID, thumb FROM video
//            WHERE VID IN (SELECT VID FROM video WHERE title LIKE "%'.$Channel['name'].'%" ORDER BY viewtime DESC LIMIT 5) ORDER BY RAND() LIMIT 1';

        //清除CrawlerItem
        $statement = 'delete from crawler_items where ci_id Not in (select ci_id from ctasks_items)';
        DB::statement($statement);

        //清除CrawlerShop
        //$statement = 'delete from crawler_shops where crawler_shops.shopid Not in (select crawler_items.shopid from crawler_items)';
        $statement = 'delete from crawler_shops where crawler_shops.shopid Not in (select c_item.shopid from (select * from crawler_items limit 100) AS c_item)';
        DB::statement($statement);

        //清除CrawlerItemSKU
        $statement = 'delete from citem_sku_details where citem_sku_details.modelid Not in (select citem_skus.modelid from citem_skus)';
//        $statement = 'delete from citem_sku_details where citem_sku_details.modelid Not in (select c_sku.modelid from (select * from citem_skus) AS c_sku ) limit 100';
//        $statement = 'delete from citem_sku_details as ci_sku_detail INNER JOIN ( select citem_skus.modelid from citem_skus ) as citem_sku on ci_sku_detail.modelid <> citem_sku.modelid';
        DB::statement($statement);

        //插播
//        $statement = 'DELETE FROM users WHERE id > 2';
//        DB::statement($statement);

        //刪除SKU

        //山除SKU Detail
    }
}
