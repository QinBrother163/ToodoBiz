<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class TdoUserCmdCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email=null} {password=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建用户';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $name = explode('@', $email)[0];
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }

    public function create()
    {
        $args = $this->argument('args');
        if ($args == 'null') return;

        $args = explode('&', $args);
        $kvs = [];
        foreach ($args as $arg) {
            $kv = explode('=', $arg);
            $kvs[$kv[0]] = $kv[1];
        }
    }
}
