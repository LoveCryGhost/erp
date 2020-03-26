<?php

namespace App\Listeners;

use App\Events\UserLoginSuccessfulEvent;
use App\Models\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Zhuzhichao\IpLocationZh\Ip;

class UserLoginSuccessfulListener
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
     * @param  UserLoginSuccessfulEvent  $event
     * @return void
     */
    public function handle(UserLoginSuccessfulEvent $event)
    {
        //獲取事件中儲存的資訊
        $user = $event->getUser();
        $agent = $event->getAgent();
        $ip = $event->getIp();
        $timestamp =  date( "Y-m-d H:i:s", $event->getTimestamp());

        //登入資訊
        $login_info = [
            'ip' => $ip,
            'login_at' => $timestamp,
            'user_id' => $user->id
        ];

        // zhuzhichao/ip-location-zh 包含的方法獲取ip地理位置
        $addresses = Ip::find($ip);
        $login_info['address'] = implode(' ', $addresses);

        // jenssegers/agent 的方法來提取agent資訊
        $login_info['device'] = $agent->device(); //裝置名稱
        $browser = $agent->browser();
        $login_info['browser'] = $browser . ' ' . $agent->version($browser); //瀏覽器
        $platform = $agent->platform();
        $login_info['platform'] = $platform . ' ' . $agent->version($platform); //作業系統
        $login_info['language'] = implode(',', $agent->languages()); //語言

        //裝置型別
        if ($agent->isTablet()) {
            // 平板
            $login_info['device_type'] = 'tablet';
        } else if ($agent->isMobile()) {
            // 便捷裝置
            $login_info['device_type'] = 'mobile';
        } else if ($agent->isRobot()) {
            // 爬蟲機器人
            $login_info['device_type'] = 'robot';
            $login_info['device'] = $agent->robot(); //機器人名稱
        } else {
            // 桌面裝置
            $login_info['device_type'] = 'desktop';
        }
        //插入到資料庫
        UserLog::insert($login_info);
    }
}
