<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailVerified
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

    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        // 会话里闪存认证成功后的消息提醒
        session()->flash('toast', [
            "heading" => "您已成功驗證郵箱",
            "text" =>  '',
            "position" => "bottom-right",
            "loaderBg" => "#ff6849",
            "icon" => "info",
            "hideAfter" => 3000,
            "stack" => 6
        ]);

    }
}
