<?php

use App\Handlers\BarcodeHandler;
use App\Imports\MHMoldImport;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Excel;

class ExcelImportSeeder extends Seeder
{
    public function run()
    {
        //MHMoldExcelImport
        /*
         * 打開Excel
         * 讀取
         * 寫入
         * */

    }

    public function MHMoldExcelImport()
    {
        Excel::import(new MHMoldImport(), storage_path('MHMoldExcelImport.xlsx'));

        return redirect('/')->with('success', 'All good!');
    }
}
