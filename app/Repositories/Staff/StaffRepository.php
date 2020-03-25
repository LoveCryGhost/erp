<?php

namespace App\Repositories\Staff;


use App\Models\Staff;
use App\Repositories\Member\RepositoryInterface;

class StaffRepository extends StaffCoreRepository implements RepositoryInterface
{
    private $Staff;
    public function __construct(Staff $Staff)
    {
        $this->Staff = $Staff;
    }

    public function builder()
    {
        return $this->Staff;
    }

    public function getById($id)
    {
        return $this->Staff->find($id);
    }
}
