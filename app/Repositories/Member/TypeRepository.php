<?php

namespace App\Repositories\Member;


use App\Models\Type;

class TypeRepository extends MemberCoreRepository implements RepositoryInterface
{

    private $type;

    public function __construct(Type $type)
    {
        $this->type = new Type();
    }

    public function builder()
    {
        return $this->type ;
    }


    public function getById($id)
    {
        return $this->type->find($id);
    }
}
