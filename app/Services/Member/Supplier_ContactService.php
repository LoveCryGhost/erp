<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Models\Product;
use App\Models\SupplierContact;
use App\Repositories\Member\ProductRepository;
use App\Repositories\Member\SKURepository;
use App\Repositories\Member\SupplierContactRepository;
use App\Repositories\Member\SupplierRepository;
use App\Repositories\Member\TypeRepository;

class Supplier_ContactService extends MemberCoreService implements MemberServiceInterface
{

    public $supplierContactRepo;
    public $supplierRepo;

    public function __construct(SupplierContactRepository $supplierContactRepository, SupplierRepository $supplierRepository)
    {
        $this->supplierRepo = $supplierRepository;
        $this->supplierContactRepo = $supplierContactRepository;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($data)
    {
        //儲存一般資料
        $supplierContact =$this->supplierContactRepo->builder()->create($data);
        return $supplierContact;

    }

    public function update($supplierContact, $data)
    {
        return $this->supplierContactRepo->update($supplierContact, $data);
    }

    public function destroy($supplierContact, $data)
    {
        return $this->supplierContactRepo->destroy($supplierContact, $data);
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
