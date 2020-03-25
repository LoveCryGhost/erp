<?php

namespace App\Http\Controllers\Member;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Member\SupplierGroupRequest;
use App\Models\SupplierGroup;
use App\Services\Member\SupplierGroupService;
use Illuminate\Http\Request;


class SupplierGroupsController extends MemberCoreController
{

    protected $supplierGroupService;

    public function __construct(SupplierGroupService $supplierGroupService)
    {
        $this->middleware('auth:member');
        $this->supplierGroupService = $supplierGroupService;
    }

    public function create()
    {
        $types = $this->supplierGroupService->supplierGroupRepo->builder()->all();
        return view(config('theme.member.view').'supplierGroup.create', compact('types'));
    }

    public function store(SupplierGroupRequest $request)
    {
        $data = $request->all();
        $toast = $this->supplierGroupService->store($data);
        return redirect()->route('member.supplierGroup.index')->with('toast', parent::$toast_store);

    }

    public function index()
    {
        $supplierGroups = $this->supplierGroupService->index();
        return view(config('theme.member.view').'supplierGroup.index', compact('supplierGroups'));
    }

    public function edit(SupplierGroup $supplierGroup)
    {
        $this->authorize('update', $supplierGroup);
        return view(config('theme.member.view').'supplierGroup.edit', compact('supplierGroup'));
    }

    public function update(SupplierGroupRequest $request, SupplierGroup $supplierGroup)
    {
        $this->authorize('update', $supplierGroup);
        $data = $request->all();
        $toast = $this->supplierGroupService->update($supplierGroup, $data);
        return redirect()->route('member.supplierGroup.index')->with('toast',  parent::$toast_update);
    }


    public function destroy(Request $request, SupplierGroup $supplierGroup)
    {
        $this->authorize('destroy', $supplierGroup);
        $data = $request;
        $toast = $this->supplierGroupService->destroy($supplierGroup, $data);
        return redirect()->route('member.supplierGroup.index')->with('toast',  parent::$toast_destroy);
    }

}
