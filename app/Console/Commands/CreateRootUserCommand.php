<?php

namespace App\Console\Commands;

use App\Data\UserType;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateRootUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:root-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create root user for the portal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = env('ROOT_USER_EMAIL');
        $name = env('ROOT_USER_NAME');
        $password = env('ROOT_USER_PASSWORD');

        if (User::where('email', $email)->first()) {
            $this->error("root user already exist");
            exit(1);
        }

        $model = new User();
        $model->email = $email;
        $model->name = $name;
        $model->password = Hash::make($password);
        $model->user_type = UserType::ROOT;
        $model->save();

        $this->info("User added!");
        exit(0);
    }
}
