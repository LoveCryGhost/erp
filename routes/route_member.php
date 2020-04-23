<?php
//Member
use Illuminate\Support\Facades\Route;

Route::prefix('member')->namespace('Member')->group(function(){
    Route::put('member_update_password/{member}', 'MembersController@update_password')->name('member.update_password');
    Route::resource('member', 'MembersController');
    Route::prefix('')->name('member.')->group(function(){

        //SupplierGroup
        Route::resource('supplier', 'SuppliersController');
        Route::resource('supplierGroup', 'SupplierGroupsController');
        Route::resource('supplier-contact', 'Supplier_ContactsController');

        //Type
        Route::resource('type', 'TypesController');
        Route::resource('type-attribute', 'Types_AttributesController');

        //Attribute
        Route::resource('attribute', 'AttributesController');

        //Product
        Route::resource('product', 'ProductsController');
        Route::resource('product-sku', 'Product_SKUsController');
        Route::resource('product-sku-supplier', 'Product_SKU_SuppliersController');

        //Crawler
        Route::resource('crawlertask', 'CrawlerTasksController');
        Route::post('crawlertask_refresh', 'CrawlerTasksController@refresh')->name('crawler.refresh');
        Route::resource('crawleritem', 'CrawlerItemsController');
        Route::post('crawleritem_toggle', 'CrawlerItemsController@toggle')->name('crawleritem.toggle');
        Route::post('crawleritem_save_cralwertask_info', 'CrawlerItemsController@save_cralwertask_info')->name('crawleritem.save_cralwertask_info');

        Route::resource('crawleritemsku', 'CrawlerItemSKUsController');
        Route::post('crawleritemsku-put_product_id', 'CrawlerItemSKUsController@put_product_id')->name('crawleritemsku.put_product_id');
        Route::post('crawleritemsku-show_product_skus', 'CrawlerItemSKUsController@show_product_skus')->name('crawleritemsku.show_product_skus');
        Route::post('crawleritemsku-bind_product_sku_to_crawler_sku', 'CrawlerItemSKUsController@bind_product_sku_to_crawler_sku')->name('crawleritemsku.bind_product_sku_to_crawler_sku');

        //PurchaseOrderCartItem
        Route::post('purchaseOrderCartItem_add', 'PurchaseOrderCartItemsController@add')->name('purchaseOrderCartItem.add');
        Route::get('purchaseOrderCartItem_index', 'PurchaseOrderCartItemsController@index')->name('purchaseOrderCartItem.index');


    });

    //Member - Report
    Route::prefix('')->namespace('Report')->name('member.reports.sku.')->group(function(){
        Route::get('crawleritem_analysis', 'ReportSKUController@crawleritem_analysis')->name('crawleritem_analysis');
    });
});