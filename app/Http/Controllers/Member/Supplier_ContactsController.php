<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\Supplier_ContactRequest;
use App\Models\SupplierContact;
use App\Services\Member\Supplier_ContactService;
use App\Services\Member\SupplierService;
use Illuminate\Http\Request;



class Supplier_ContactsController extends MemberCoreController
{


    private $supplierService;
    private $supplier_ContactService;

    public function __construct(SupplierService $supplierService, Supplier_ContactService $supplier_ContactService)
    {
        $this->middleware('auth:member');
        $this->supplier_ContactService= $supplier_ContactService;
        $this->supplierService= $supplierService;
    }

    public function create(Request $request)
    {
        $supplier= $this->supplierService->supplierRepo->getById($request->input('s_id'));
        $view = view(config('theme.member.view').'supplier.supplierContact.md-create', compact('supplier'))->render();
        return [
            'errors' => '',
            'models'=> [],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function store(Supplier_ContactRequest $request)
    {
        $data = $request->all();
        $supplierContact =$this->supplier_ContactService->store($data);
        return [
            'errors' => '',
            'models'=> [
                    'supplier' => $supplierContact->supplier,
                    'supplierContact' => $supplierContact
                ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function edit(Request $request, SupplierContact $supplierContact)
    {

        $this->authorize('update', $supplierContact);
        $data = $request->all();
        $supplier= $this->supplier_ContactService->supplierRepo->getById($request->input('s_id'));
        $view = view(config('theme.member.view').'supplier.supplierContact.md-edit', compact('supplier', 'supplierContact'))->render();

        return [
            'errors' => '',
            'models'=> [
                'supplierContact' => $supplierContact
            ],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function update(Supplier_ContactRequest $request, SupplierContact $supplierContact)
    {
        $this->authorize('update', $supplierContact);
        $data = $request->all();
        $TF = $this->supplier_ContactService->update($supplierContact, $data);
        return [
            'errors' => '',
            'models'=> [
                'supplier' => $supplierContact->supplier,
                'supplierContact' => $supplierContact
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function destroy(Request $request, SupplierContact $supplierContact)
    {
        $this->authorize('destroy', $supplierContact);
        $data = $request->all();
        $TF = $this->supplier_ContactService->destroy($supplierContact, $data);
        return [
            'errors' => '',
            'models'=> [
                'supplierContact' => $supplierContact
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }
}
