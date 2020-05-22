<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\TypeRequest;
use App\Models\Type;
use App\Services\Member\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $attributes = $this->typeService->attributeRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->get();
        return view(config('theme.member.view').'type.create', compact('attributes'));
    }

    public function store(TypeRequest $request)
    {
        $data = $request->all();
        $type = $this->typeService->store($data);
        if(isset($data['a_ids'])==true) {
            $a_ids = array_values($data['a_ids']);
            $this->typeService->attributeRepo->save($type, $a_ids);
        }
        return redirect()->route('member.type.index')->with('toast', parent::$toast_store);
    }

    public function index()
    {
        $query = $this->typeService->typeRepo->builder();
        $types = $query->where('member_id', Auth::guard('member')->user()->id)->paginate(10);
        return view(config('theme.member.view').'type.index', compact('types'));
    }

    public function edit(Type $type)
    {
        $this->authorize('update', $type);
        $attributes = $this->typeService->attributeRepo->builder()
            ->where('member_id', Auth::guard('member')->user()->id)
            ->get();
        return view(config('theme.member.view').'type.edit', compact('type', 'attributes'));
    }

    public function update(TypeRequest $request, Type $type)
    {
        $this->authorize('update', $type);
        $data = $request->all();
        $TF = $this->typeService->update($type, $data);

        if(isset($data['a_ids'])==true) {
            $a_ids = array_values($data['a_ids']);
            $this->typeService->attributeRepo->save($type, $a_ids);
        }
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
