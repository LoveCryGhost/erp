<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\TypeRepository;

class Type_AttributeService extends MemberCoreService implements MemberServiceInterface
{
    public $attributeRepo;
    public $typeRepo;

    public function __construct(AttributeRepository $attributeRepository, TypeRepository $typeRepository)
    {
        $this->typeRepo = $typeRepository;
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
        $type = $this->typeRepo->getById($data['t_id']);
        return $type->attributes()->detach([$attribute->a_id]);
    }


}
