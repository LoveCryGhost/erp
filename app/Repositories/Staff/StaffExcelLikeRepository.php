<?php

namespace App\Repositories\Staff;


use App\Models\Staff;
use App\Models\StaffDepartment;
use App\Models\StaffExcelLike;
use App\Repositories\Member\RepositoryInterface;

class StaffExcelLikeRepository extends StaffCoreRepository implements RepositoryInterface
{
    private $staffExcelLike;
    public function __construct(StaffExcelLike $staffExcelLike)
    {
        $this->staffExcelLike = $staffExcelLike;
    }

    public function builder()
    {
        return $this->staffExcelLike;
    }

    public function getById($id)
    {
        return $this->staffExcelLike->find($id);
    }
}
