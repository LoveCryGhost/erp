<?php

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\Controller;

class StaffCoreController extends Controller
{
    public  static $toast_update = [
        "heading" => "更新成功",
        "text" =>  '',
        "position" => "top-right",
        "loaderBg" => "#ff6849",
        "icon" => "success",
        "hideAfter" => 3000,
        "stack" => 6
    ];

    public static $toast_store = [
        "heading" => "新增成功",
        "text" =>  '',
        "position" => "top-right",
        "loaderBg" => "#ff6849",
        "icon" => "success",
        "hideAfter" => 3000,
        "stack" => 6
    ];

    public static $toast_destroy = [
        "heading" => "新增成功",
        "text" =>  '',
        "position" => "top-right",
        "loaderBg" => "#ff6849",
        "icon" => "success",
        "hideAfter" => 3000,
        "stack" => 6
    ];
}
