<?php

namespace App\Services\Staff;

use App\Repositories\Staff\StaffExcelLikeRepository;
use App\Repositories\Staff\StaffRepository;
use App\Rules\CurrentPasswordRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffExcelLikeService extends StaffCoreService implements StaffServiceInterface
{
    public $staffRepo;
    public $staffExcelLikeRepo;

    public function __construct(StaffRepository $staffRepo, StaffExcelLikeRepository $staffExcelLikeRepo)
    {
        $this->staffExcelLikeRepo = $staffExcelLikeRepo;
        $this->staffRepo =$staffRepo;
    }


    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function update($model, $data)
    {
//        $staff = $model;
//
//        return  $staff->staffDepartments()->wherePivot('sd_id', $data['sd_id'])->updateExistingPivot(
//            $data['old_d_id'] , [
//            'st_id' => $data['st_id'],
//            'bonus' => $data['bonus'],
//            'd_id' => $data['d_id'],
//            'start_at' => $data['start_at'],
//            'modified_by' => Auth::guard('staff')->user()->id
//        ]);
    }

    public function destroy($model, $data)
    {
        // TODO: Implement destroy() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
