<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Member\Product_SKU_SupplierRequest;
use App\Http\Requests\Staff\Staff_DepartmentRequest;
use App\Models\StaffDepartment;
use App\Services\Staff\Staff_DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Staff_DepartmentsController extends StaffCoreController
{
    private $staff_DepartmentService;

    public function __construct(Staff_DepartmentService $staff_DepartmentService)
    {
        $this->middleware('auth:staff');
        $this->staff_DepartmentService = $staff_DepartmentService;
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $staffDepartments = StaffDepartment::get();
        $view = view(config('theme.staff.view').'staff.staffDepartment.md-create',compact('data','staff', 'staffDepartments'))->render();

        return [
            'errors' => '',
            'models'=> [
                'sku' => '',
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function edit()
    {
        $data = request()->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $staff_department_current_pivot = $staff->staffDepartments()->wherePivot('sd_id',$data['sd_id'])->get()->last()->pivot;
        $creator_name = $this->staff_DepartmentService->StaffRepo->getById($staff_department_current_pivot->created_by);
        $staffDepartments = StaffDepartment::get();
        $view = view(config('theme.staff.view').'staff.staffDepartment.md-edit',compact('data','staff','staffDepartments', 'staff_department_current_pivot','creator_name'))->render();

        return [
            'errors' => '',
            'models'=> [
                'sku' => '',
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }



    public function update(Staff_DepartmentRequest $request)
    {
        $data = $request->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $TF =$this->staff_DepartmentService->update($model = $staff, $data);

        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        return [
            'errors' => '',
            'models'=> [
                'staff' => $staff,
                ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function store(Staff_DepartmentRequest $request)
    {
        $data = $request->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);
        $staff->staffDepartments()->attach([
            $data['d_id']=> [
                                'created_by' => Auth::guard('staff')->user()->id,
                                'modified_by' => Auth::guard('staff')->user()->id,
                                'bonus' => $data['bonus'],
                                'start_at' =>  $data['start_at']
                            ]
        ]);
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);

        return [
            'errors' => '',
            'models'=> [
                'staff' => $staff,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $staff = $this->staff_DepartmentService->StaffRepo->getById($data['st_id']);

        $staff->staffDepartments()->wherePivot('sd_id', $data['sd_id'])->detach();
    }
}
