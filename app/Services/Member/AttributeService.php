<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;

class AttributeService extends MemberCoreService implements MemberServiceInterface
{
    public $attributeRepo;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepo = $attributeRepository;
    }

    public function index()
    {
        return $this->attributeRepo->builder()->paginate(10);
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store($data)
    {
        return $this->attributeRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
        $attribute = $model;
        return $attribute->update($data);
    }

    public function destroy($model, $data)
    {
        $attribute = $model;
        return $attribute->delete();
    }


}
