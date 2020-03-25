<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Services\Member\AttributeService;
use App\Services\Member\Type_AttributeService;
use Illuminate\Http\Request;


class Types_AttributesController extends MemberCoreController
{

    private $type_attributeService;

    public function __construct(Type_AttributeService $type_AttributeService)
    {
        $this->middleware('auth:member');
        $this->type_attributeService = $type_AttributeService;
    }

    public function create(Request $request)
    {

        $attributes = $this->type_attributeService->attributeRepo->builder()->all();
        $view = view(config('theme.member.view').'type.attribute.md-create', compact('attributes'))->render();
        return [
            'errors' => '',
            'models'=> [],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function store(Request $request)
    {
        $attribute = $this->type_attributeService->attributeRepo->builder()->find($request->input('a_id'));

        return [
            'errors' => '',
            'models'=> [
                'attribute' => $attribute,
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }

    public function index()
    {
        $attributes = $this->type_attributeService->index();
        return view(config('theme.member.view').'attribute.index', compact('attributes'));
    }

    public function edit(Request $request, Attribute $typeAttribute)
    {
        $attribute = $typeAttribute;
        $attributes = $this->type_attributeService->attributeRepo->builder()->all();
        $view = view(config('theme.member.view').'type.attribute.md-edit', compact('attributes','attribute'))->render();
        return [
            'errors' => '',
            'models'=> [],
            'request' => $request->all(),
            'view' => $view,
            'options'=>[]
        ];
    }

    public function update(Request $request)
    {
        $attribute = $this->type_attributeService->attributeRepo->builder()->find($request->input('a_id'));

        return [
            'errors' => '',
            'models'=> ['attribute'=>$attribute],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }


    public function destroy(Request $request, Attribute $type_attribute)
    {
        $attribute = $type_attribute;
        $data = $request->all();
        $TF = $this->type_attributeService->destroy($attribute, $data);
        dd($TF);
        return [
            'errors' => '',
            'models'=> [
                'attribute' => $attribute
            ],
            'request' => $request->all(),
            'view' => '',
            'options'=>[]
        ];
    }
}
