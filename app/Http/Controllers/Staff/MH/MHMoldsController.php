<?php

namespace App\Http\Controllers\Staff\MH;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Staff\StaffCoreController;
use App\Models\Shoes\ShoesMold;
use App\Models\Staff;
use function config;

class MHMoldsController extends StaffCoreController
{

    public function __construct()
    {
        $actions = [
            'index',
            'show', 'edit','update',
            'create', 'store',
            'destroy',
            'show'];
        $this->coreMiddleware('MHMoldsController', $guard='staff', $route="mhMold", $actions);
    }

    public function index()
    {
        $shoesMolds = ShoesMold::with(['department'])->paginate(10);
        return view(config('theme.staff.view').'mh.mold.index',[
            'shoesMolds' => $shoesMolds,
            'filters' =>[

            ]
        ]);
    }

    public function create()
    {

    }

    public function edit()
    {

    }
}
