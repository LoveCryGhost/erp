<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\SupplierRequest;
use App\Models\Supplier;
use App\Observers\SupplierContactObserver;
use App\Services\Member\Supplier_ContactService;
use App\Services\Member\SupplierGroupService;
use App\Services\Member\SupplierService;


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
        $supplierGroups= $this->supplierGroupService->supplierGroupRepo->builder()->all();
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
        $suppliers = $this->supplierService->index();
        return view(config('theme.member.view').'supplier.index', compact('suppliers'));
    }

    public function edit(Supplier $supplier)
    {
        $this->authorize('update', $supplier);
        $supplierGroups= $this->supplierGroupService->supplierGroupRepo->builder()->all();
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

}
