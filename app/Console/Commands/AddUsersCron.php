<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddUsersCron extends Command
{

    protected $signature = 'command:add_users';

    protected $description = 'Command add_users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $name= 'a'.random_int(1000, 9999999);
        $email = $name.'@app.comTestCorn';
        User::create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar' => '',
            'birthday' => null,
            'introduction' => 'aaa',
        ]);
    }
}
