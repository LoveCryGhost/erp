<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\SupplierRequest;
use App\Models\Supplier;
use App\Observers\SupplierContactObserver;
use App\Services\Member\Supplier_ContactService;
use App\Services\Member\SupplierGroupService;
use App\Services\Member\SupplierService;
use Illuminate\Support\Facades\Auth;
use function app;
use function request;


class SuppliersController extends MemberCoreController
{

    protected $supplierService;
    private $supplierGroupService;

    public function __construct(SupplierService $supplierService, supplierGroupService $supplierGroupService)
    {
        $this->middleware('auth:member');
        $this->supplierService = $supplierService;
        $this->supplierGroupService = $supplierGroupService;
    }

    public function create()
    {
        $supplierGroups= $this->supplierGroupService->supplierGroupRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->get();
        return view(config('theme.member.view').'supplier.create', compact('supplierGroups'));
    }

    public function store(SupplierRequest $request)
    {
        $data = $request->all();
        $toast = $this->supplierService->store($data);
        return redirect()->route('member.supplier.index')->with('toast', parent::$toast_store);

    }

    public function index()
    {
        $query = $this->supplierService->supplierRepo->builder();
        $this->filters = [
            's_name' => request()->s_name,
            'id_code' => request()->id_code,
            'sg_name' => request()->sg_name,
            'sc_name' => request()->sc_name,
            'tel' => request()->tel,
            'phone' => request()->phone,
        ];
        $query = $this->index_filters($query, $this->filters);
        $suppliers = $query->with(['supplierGroup','all_supplierContacts', 'member'])
            ->where('member_id', Auth::guard('member')->user()->id)
            ->paginate(10);
        return view(config('theme.member.view').'supplier.index', compact('suppliers'));
    }

    public function edit(Supplier $supplier)
    {
        $this->authorize('update', $supplier);
        $supplierGroups= $this->supplierGroupService->supplierGroupRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->get();
        return view(config('theme.member.view').'supplier.edit', compact('supplier','supplierGroups'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $this->authorize('update', $supplier);
        $data = $request->all();
        $TF = $this->supplierService->update($supplier, $data);
        return redirect()->route('member.supplier.index')->with('toast',  parent::$toast_update);
    }


    public function destroy(Supplier $supplier)
    {
        $this->authorize('destroy', $supplier);
        $toast = $this->supplierService->destroy($supplier);
        return redirect()->route('member.supplier.index')->with('toast',  parent::$toast_destroy);
    }

    public function index_filters($query, $filters)
    {
        $query  = $this->filter_like($query,'s_name', $filters['s_name']);
        $query  = $this->filter_like($query,'id_code', $filters['id_code']);
        if(!empty($filters['sg_name'])){
            $query = $query->whereHas('supplierGroup', function ($q) use($filters) {
                $q->where('sg_name', 'LIKE', '%'.$filters['sg_name'].'%');
            });
        }

        if(!empty($filters['sc_name'])){
            $query = $query->whereHas('all_supplierContacts', function ($q) use($filters) {
                $q->where('sc_name', 'LIKE', '%'.$filters['sc_name'].'%');
            });
        }
        if(!empty($filters['tel'])){
            $query = $query->whereHas('all_supplierContacts', function ($q) use($filters) {
                $q->where('tel', 'LIKE', '%'.$filters['tel'].'%');
            });
        }
        if(!empty($filters['phone'])){
            $query = $query->whereHas('all_supplierContacts', function ($q) use($filters) {
                $q->where('phone', 'LIKE', '%'.$filters['phone'].'%');
            });
        }
        return $query;
    }
}
