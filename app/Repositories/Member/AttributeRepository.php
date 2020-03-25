<?php

namespace App\Repositories\Member;

use App\Models\Attribute;

class AttributeRepository extends MemberCoreRepository implements RepositoryInterface
{

    private $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = new Attribute();
    }

    public function builder()
    {
        return $this->attribute ;
    }

    public function getById($id){
        return $this->attribute->find($id);
    }

    public function save($type, $attribute_ids){
        foreach ($attribute_ids as $index => $attribute_id){
            $types_attributes[$attribute_id] = ['sort_order'=>$index];
        }
        $type->attributes()->sync($types_attributes);
    }
}
