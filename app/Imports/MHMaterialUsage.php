<?php

namespace App\Imports;

use App\Models\Shoes\ShoesMold;
use App\Models\StaffDepartment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use function array_push;
use function str_replace;

class MHMaterialUsage implements ToCollection, WithChunkReading, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        $staffDepartments = StaffDepartment::pluck('d_id','name');
        foreach ($rows as $row)
        {
            $department = $row['department'];
            switch ($department){
                case "IP":
                    $row['department_id'] = $staffDepartments[$department];
                    break;

                case "RB":
                    $row['department_id'] = $staffDepartments[$department];
                    break;

                case "SP":
                    $row['department_id'] = $staffDepartments[$department];
                    break;

                default:
                    $row['department_id'] = 0;
            }


            ShoesMold::create([
                'department_id' =>  $row['department_id'],
                'proccess_order' =>  $row['proccess_order'],
                'proccess' =>  $row['proccess'],
                'mold_type' =>  $row['mold_type'],
                'keep_vendor' =>  $row['keep_vendor'],
                'm_id' =>  rand(1,4),
                'size' =>  str_replace("#","",$row['size']),
                'series' =>  $row['series'],
                'vendor' =>  $row['vendor'],
                'qty' =>  $row['qty'],
                'pairs' =>  $row['pairs'],
                'cycle_time' =>  $row['cycle_time'],
                'condition' =>  $row['condition'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    //標題
    public function headingRow(): int
    {
        return 2;
    }
}