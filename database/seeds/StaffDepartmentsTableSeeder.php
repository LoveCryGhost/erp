<?php

use App\Models\StaffDepartment;
use Illuminate\Database\Seeder;

class StaffDepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        $department_processes = [
            "IP" => [
                "Material" => "備料",
                "Operation" => "操機員",
                "Trimming" => "修編",
                "Sizing" => "分碼",
                "Clean" => "清潔",
                "Packing" => "包裝",
                "Delivery" => "入庫",
                "Others" => "其他",
            ],

            "SP" => [
                "Material_EVA" => "裁EVA",
                "Material_Clothes" => "裁布",
                "ColdPress" => "冷壓",
                "Punching" => "沖孔",
                "CleanPunching" => "清孔",
                "CutFoam" => "裁泡綿",
                "1stCementEVA" => "第1次-過本體",
                "1stCementFoam" => "第1次-過泡綿",
                "BrushCement" => "刷膠",
                "AttachingFoam" => "貼泡綿",
                "2ncCementEVA" => "第2次-過本體",
                "AttachingClothes" => "貼布",
                "Modeling" => "回模",
                "Cutting" => "裁成品",
                "Trimming" => "修編",
                "QC" => "品檢",
                "Packing" => "包裝",
                "Repairing" => "整理",
                "Others" => "其他",
            ],

            "Warehouse" => [],
            "RB" => [],
            "Model" => [],
            "Accounting" => [],
        ];

        foreach ($department_processes as $department => $processes){
            $staffDepartment = StaffDepartment::create([
                'processes' => $department,
                'name' => $department,
            ]);
            foreach ($processes as $process => $process_name){
                $dp_process = (new StaffDepartment());
                $dp_process->processes = $process;
                $dp_process->name = $process_name;
                $dp_process->parent_id = $staffDepartment->d_id;
                $dp_process->save();
            }
        }
    }
}
