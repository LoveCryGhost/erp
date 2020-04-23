<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\StaffCoreController;
use App\Models\Staff;
use App\Models\StaffExcelLike;
use App\Services\Staff\StaffExcelLikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function compact;
use function config;
use function redirect;
use function str_replace;
use function view;

class StaffExcelLikeController extends StaffCoreController
{
    public $staffExcelLikeService;
    public function __construct(StaffExcelLikeService $staffExcelLikeService)
    {
        $this->middleware(['auth:staff']);
        $this->middleware(['permission:staff.staffExcelLike.index'])->only('index');
        $this->middleware(['permission:staff.staffExcelLike.create'])->only('create');
        $this->middleware(['permission:staff.staffExcelLike.edit'])->only('edit');
        $this->middleware(['permission:staff.staffExcelLike.update'])->only('update');

        $this->staffExcelLikeService = $staffExcelLikeService;
    }

    public function index(){
        $staffExcelLikes = $this->staffExcelLikeService
                                ->staffExcelLikeRepo->builder()
                                ->where('pic', Auth::guard('staff')->user()->id)
                                ->with('staff')
                                ->get();
        return view(config('theme.staff.view').'excellike.index', ['staffExcelLikes' => $staffExcelLikes]);
    }

    public function create(){
        return view(config('theme.staff.view') . 'excellike.create');
    }

    public function store(Request $request){

        StaffExcelLike::create([
            'pic' => Auth::guard('staff')->user()->id,
            'is_active' => $request->is_active,
            'showable' => $request->showable,
            'editable' => $request->editable,
            'title' => $request->title,
            'description' => $request->description,
            'jquery' => $request->jquery,
            'excel_content' => $request->excel_content
        ]);
        return redirect()->route('staff.staffExcelLike.index');
    }

    public function edit(StaffExcelLike $staffExcelLike){

        $this->authorize('update', $staffExcelLike);
        return view(config('theme.staff.view').'excellike.edit', ['staffExcelLike' => $staffExcelLike]);
    }

    public function update(Request $request, StaffExcelLike $staffExcelLike){
        $this->authorize('update', $staffExcelLike);

        $staffExcelLike->update([
            'pic' => Auth::guard('staff')->user()->id,
            'is_active' => $request->is_active,
            'showable' => $request->showable,
            'editable' => $request->editable,
            'title' => $request->title,
            'description' => $request->description,
            'jquery' => $request->jquery,
            'excel_content' => $request->excel_content
        ]);
        return redirect()->route('staff.staffExcelLike.index');
    }
}
