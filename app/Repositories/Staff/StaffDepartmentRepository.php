<?php

namespace App\Repositories\Staff;


use App\Models\Staff;
use App\Models\StaffDepartment;
use App\Repositories\Member\RepositoryInterface;

class StaffDepartmentRepository extends StaffCoreRepository implements RepositoryInterface
{
    private $StaffDepartment;
    public function __construct(StaffDepartment $staffDepartment)
    {
        $this->StaffDepartment = $staffDepartment;
    }

    public function builder()
    {
        return $this->StaffDepartment;
    }

    public function getById($id)
    {
        return $this->StaffDepartment->find($id);
    }
}
