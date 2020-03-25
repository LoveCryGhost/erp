<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

class ResetPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(PasswordReset $event)
    {
        // 会话里闪存认证成功后的消息提醒
        session()->flash('toast', [
            "heading" => "您已成功更改密碼",
            "text" =>  '',
            "position" => "bottom-right",
            "loaderBg" => "#ff6849",
            "icon" => "info",
            "hideAfter" => 3000,
            "stack" => 6
        ]);
    }
}
