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
            Route::resource('sku', 'SKUController');

            //Crawler
            Route::resource('crawlerTask', 'CrawlerTasksController');
            Route::post('crawlerTask_refresh', 'CrawlerTasksController@refresh')->name('crawlerTask.refresh');
            Route::resource('crawlerItem', 'CrawlerItemsController');
            Route::post('crawlerItem_toggle', 'CrawlerItemsController@toggle')->name('crawlerItem.toggle');
                //Route::get('crawlerItem_toggle', 'CrawlerItemsController@toggle')->name('crawlerItem.toggle');
            Route::post('crawlerItem_saveCralwerTaskInfo', 'CrawlerItemsController@saveCralwerTaskInfo')->name('crawlerItem.saveCralwerTaskInfo');

            Route::resource('crawlerItem-crawlerItemSku', 'CrawlerItem_CrawlerItemSKUsController');
            Route::post('crawlerItem-crawlerItemSku_putProductId', 'CrawlerItem_CrawlerItemSKUsController@putProductId')->name('crawlerItem-crawlerItemSku.putProductId');
            Route::post('crawlerItem-crawlerItemSku_showProductSkus', 'CrawlerItem_CrawlerItemSKUsController@showProductSkus')->name('crawlerItem-crawlerItemSku.showProductSkus');
            Route::post('crawlerItem-crawlerItemSku_bindProductSkuToCrawlerSku', 'CrawlerItem_CrawlerItemSKUsController@bindProductSkuToCrawlerSku')->name('crawlerItem-crawlerItemSku.bindProductSkuToCrawlerSku');

            Route::resource('crawlerItemSearch', 'CrawlerItemSearchsController');
            //PurchaseOrderCartItem
            Route::post('purchaseOrderCartItem_add', 'PurchaseOrderCartItemsController@add')->name('purchaseOrderCartItem.add');
            Route::get('purchaseOrderCartItem_index', 'PurchaseOrderCartItemsController@index')->name('purchaseOrderCartItem.index');
        });

        //Member - Report
        Route::prefix('')->namespace('Report')->name('member.')->group(function () {
            Route::get('reportSKU_crawlerItemAanalysis', 'ReportSKUController@crawlerItemAanalysis')->name('reportSKU.crawlerItemAanalysis');
        });

        /*
         * Tools
         * */
        //ExcelLike
        Route::prefix('tools')->namespace('Tools')->name('member.')->group(function(){
            Route::get('excel_like', 'ToolsController@excel_like')->name('tools.excel_like');
            Route::get('compound_interest', 'ToolsController@compound_interest')->name('tools.compound_interest');
        });
    });
});
