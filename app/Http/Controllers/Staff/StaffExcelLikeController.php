<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\StaffCoreController;
use App\Models\StaffExcelLike;
use App\Services\Staff\StaffExcelLikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function compact;
use function config;
use function str_replace;
use function view;

class StaffExcelLikeController extends StaffCoreController
{
    public $staffExcelLikeService;
    public function __construct(StaffExcelLikeService $staffExcelLikeService)
    {
        $this->middleware(['auth:staff']);
        $this->staffExcelLikeService = $staffExcelLikeService;
    }

    public function index(){
        $staffExcelLikes = $this->staffExcelLikeService
                                ->staffExcelLikeRepo->builder()
                                ->where('pic', Auth::guard('staff')->user()->id);
        return view(config('theme.staff.view').'excellike.index', ['staffExcelLikes' => $staffExcelLikes]);
    }

    public function create(){
        return view(config('theme.staff.view').'excellike.create');
    }

    public function store(Request $request){

        $file_name = 'public/excellike/aa'.$request->id.'.js';
        if(!empty($request->jquery)){
            Storage::put($file_name, $request->jquery);
        }else{
            Storage::delete($file_name);
        }

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
        return $this->index();
    }

    public function edit($id){
        $staffExcelLike = StaffExcelLike::where('pic', 1)->find($id);
        return view(config('theme.staff.view').'excellike.edit', ['staffExcelLike' => $staffExcelLike]);
    }

    public function update(Request $request, $excel_like){

        $staffExcelLike = StaffExcelLike::find($excel_like);
        $file_name = 'public/excellike/aa.js';
        if(!empty($request->jquery)){
            Storage::put($file_name, $request->jquery);
        }else{
            Storage::delete($file_name);
        }


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
        return $this->index();
    }
}
