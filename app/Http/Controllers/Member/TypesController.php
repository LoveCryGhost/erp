<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\TypeRequest;
use App\Models\Type;
use App\Services\Member\TypeService;
use Illuminate\Http\Request;


class TypesController extends MemberCoreController
{

    protected $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->middleware('auth:member');
        $this->typeService = $typeService;
    }

    public function create()
    {
        $attributes = $this->typeService->attributeRepo->builder()->all();
        return view(config('theme.member.view').'type.create', compact('attributes'));
    }

    public function store(TypeRequest $request)
    {
        $data = $request->all();
        $a_ids = array_values($data['a_ids']);
        $type = $this->typeService->store($data);
        $this->typeService->attributeRepo->save($type, $a_ids);
        return redirect()->route('member.type.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $types = $this->typeService->index();
        return view(config('theme.member.view').'type.index', compact('types'));
    }

    public function edit(Type $type)
    {
        $this->authorize('update', $type);
        $attributes = $this->typeService->attributeRepo->builder()->all();
        return view(config('theme.member.view').'type.edit', compact('type', 'attributes'));
    }

    public function update(TypeRequest $request, Type $type)
    {
        $this->authorize('update', $type);
        $data = $request->all();
        $TF = $this->typeService->update($type, $data);

        $a_ids = array_values($data['a_ids']);
        $this->typeService->attributeRepo->save($type, $a_ids);
        return redirect()->route('member.type.index')->with('toast', parent::$toast_update);
    }


    public function destroy(Request $request, Type $type)
    {
        $this->authorize('destroy', $type);
        $data = $request->all();
        $toast = $this->typeService->destroy($type, $data);
        return redirect()->route('member.type.index')->with('toast', parent::$toast_destroy);
    }


}
