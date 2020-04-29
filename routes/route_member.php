<?php
//Member
use Illuminate\Support\Facades\Route;

// 生成 Dashboard
// http://localhost.com/
Route::prefix('')->middleware('auth:member')->namespace('Member')->group(function() {

    //http://localhost.com/member/
    Route::prefix('member')->group(function () {
        Route::put('member_update_password/{member}', 'MembersController@update_password')->name('member.update_password');
        Route::resource('member', 'MembersController');
        Route::prefix('')->name('member.')->group(function () {

            //SupplierGroup
            Route::resource('supplier', 'SuppliersController'); //RolePermission
            Route::resource('supplierGroup', 'SupplierGroupsController'); //RolePermission
            Route::resource('supplier-contact', 'Supplier_ContactsController');

            //Type
            Route::resource('type', 'TypesController'); //RolePermission
            Route::resource('type-attribute', 'Types_AttributesController');

            //Attribute
            Route::resource('attribute', 'AttributesController'); //RolePermission

            //Product
            Route::resource('product', 'ProductsController');
            Route::resource('product-sku', 'Product_SKUsController');
            Route::resource('product-sku-supplier', 'Product_SKU_SuppliersController');

            //Crawler
            Route::resource('crawlerTask', 'CrawlerTasksController');
            Route::post('crawlertask_refresh', 'CrawlerTasksController@refresh')->name('crawler.refresh');
            Route::resource('crawlerItem', 'CrawlerItemsController');
            Route::post('crawlerItem_toggle', 'CrawlerItemsController@toggle')->name('crawlerItem.toggle');
            Route::post('crawlerItem_save_cralwerTask_info', 'CrawlerItemsController@save_cralwertask_info')->name('crawlerItem.save_cralwerTask_info');

            Route::resource('crawlerItemSku', 'CrawlerItemSKUsController');
            Route::post('crawlerItemSku-putProductId', 'CrawlerItemSKUsController@putProductId')->name('crawlerItemSku.putProductId');
            Route::post('crawlerItemSku-showProductSkus', 'CrawlerItemSKUsController@showProductSkus')->name('crawlerItemSku.showProductSkus');
            Route::post('crawlerItemSku-bind_product_sku_to_crawler_sku', 'CrawlerItemSKUsController@bind_product_sku_to_crawler_sku')->name('crawlerItemSku.bind_product_sku_to_crawler_sku');

            //PurchaseOrderCartItem
            Route::post('purchaseOrderCartItem_add', 'PurchaseOrderCartItemsController@add')->name('purchaseOrderCartItem.add');
            Route::get('purchaseOrderCartItem_index', 'PurchaseOrderCartItemsController@index')->name('purchaseOrderCartItem.index');
        });

        //Member - Report
        Route::prefix('')->namespace('Report')->name('member.reports.sku.')->group(function () {
            Route::get('crawlerItem_analysis', 'ReportSKUController@crawlerItem_analysis')->name('crawlerItem_analysis');
        });
    });
});