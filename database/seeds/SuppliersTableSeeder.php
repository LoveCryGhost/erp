<?php

use App\Handlers\BarcodeHandler;
use App\Models\Supplier;
use App\Models\SupplierContact;
use App\Models\SupplierGroup;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        $supplier_groups = [
            [
                "sg_name" => "貨運行-1",
            ],[
                "sg_name" => "貨運行-2",
            ],[
                "sg_name" => "貨運行-3",
            ]
        ];

        $index = 1;
        foreach ($supplier_groups as $supplier_group){
            SupplierGroup::create([
                'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.supplierGroup'), $index++),
                'is_active' => 0,
                'sg_name' => $supplier_group['sg_name'],
            ]);
        }



        $suppliers = [
            [
                "s_name" => "供應商-1",
                'supplier_contacts' => ['黃某某1','李某某1'],
            ],[
                "s_name" => "供應商-2",
                'supplier_contacts' => ['黃某某2','李某某2'],
            ],[
                "s_name" => "供應商-3",
                'supplier_contacts' => ['黃某某3','李某某3'],
            ]
        ];

        $index = 1;
        foreach ($suppliers as $supplier){
            $supplier_contacts = $supplier['supplier_contacts'];
            unset($supplier['supplier_contacts']);
            $Supplier =Supplier::create([
                'sg_id' => rand(1,3),
                'id_code' => (new BarcodeHandler())->barcode_generation(config('barcode.supplierGroup'), $index++),
                'is_active' => 1,
                's_name' => $supplier['s_name'],
            ]);

            foreach ($supplier_contacts as $supplier_contact){
                $supplierContact = new SupplierContact();
                $supplierContact->s_id = $Supplier->s_id;
                $supplierContact->sc_name = $supplier_contact;
                $supplierContact->save();
            }


        }
    }
}