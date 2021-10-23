<?php

namespace App\Console\Commands;

use App\Data\ApplicationType;
use App\Models\Application;
use Illuminate\Console\Command;

class CreateApplicationEntitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:application-entities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create application entities command';

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
        foreach ($this->applications() as $application) {

            if (Application::where('name', $application['name'])->first()) {
                $this->error("> application with name: {$application['name']} already exists.");
                continue;
            }

            $model = new Application($application);
            $model->save();

            $this->line("> application added: " . json_encode($model));
        }
    }

    protected function applications()
    {
        return [
            [
                'name' => 'H2H Admin',
                'detail' => 'H2H admin dashboard',
                'icon' => 'web.png',
                'type' => ApplicationType::WEB,
                'unique_id' => 'H2H-ADMIN',
            ],
            [
                'name' => 'H2H Seller',
                'detail' => 'H2H seller dashboard',
                'icon' => 'web.png',
                'type' => ApplicationType::WEB,
                'unique_id' => 'H2H-SELLER',
            ],
            [
                'name' => 'H2H Web',
                'detail' => 'H2H main website',
                'icon' => 'web.png',
                'type' => ApplicationType::WEB,
                'unique_id' => 'H2H-MAIN-WEB',
            ],
            [
                'name' => 'H2H Order app',
                'detail' => 'H2H order application',
                'icon' => 'web.png',
                'type' => ApplicationType::WEB,
                'unique_id' => 'H2H-ORDER-APP',
            ],
            [
                'name' => 'H2H api',
                'detail' => 'H2H api',
                'icon' => 'web.png',
                'type' => ApplicationType::WEB,
                'unique_id' => 'H2H-API',
            ],
            [
                'name' => 'H2H 3Menus',
                'detail' => 'H2H mobile',
                'icon' => 'mobile.png',
                'type' => ApplicationType::MOBILE,
                'unique_id' => 'H2H-3MENUS-APP',
            ],
        ];
    }
}
