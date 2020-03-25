<?php

namespace App\Services\Member;

use App\Repositories\Member\AttributeRepository;
use App\Repositories\Member\TypeRepository;
use Illuminate\Support\Facades\Auth;

class TypeService extends MemberCoreService implements MemberServiceInterface
{
    public $typeRepo;
    public $attributeRepo;

    public function __construct(TypeRepository $typeRepository, AttributeRepository $attributeRepository)
    {
        $this->typeRepo = $typeRepository;
        $this->attributeRepo = $attributeRepository;
    }

    public function index()
    {
        return $this->typeRepo->builder()
            ->with(['member'])->paginate(10);
    }

    public function create()
    {
        return $this->get();
    }



    public function edit()
    {

    }

    public function store($data)
    {
        return $this->typeRepo->builder()->create($data);
    }

    public function update($model,$data)
    {
        $type = $model;
        return $type->update($data);
    }

    public function destroy($model, $data)
    {
        $type = $model;
        return $type->delete();
    }


}
