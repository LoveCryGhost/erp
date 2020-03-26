<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\User;
use Jenssegers\Agent\Agent;
class StaffLoginSuccessfulEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User 使用者模型
     */

    protected $Staff;
    /**
     * @var Agent Agent物件
     */

    protected $agent;
    /**
     * @var string IP地址
     */

    protected $ip;
    /**
     * @var int 登入時間戳
     */

    protected $timestamp;
    /**
     * 例項化事件時傳遞這些資訊
     */

    public function __construct($Staff, $agent, $ip, $timestamp)
    {
        $this->Staff = $Staff;
        $this->agent = $agent;
        $this->ip = $ip;
        $this->timestamp = $timestamp;
    }

    public function getStaff()
    {
        return $this->Staff;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-default');
    }
}
