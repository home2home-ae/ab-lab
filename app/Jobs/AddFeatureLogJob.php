<?php

namespace App\Jobs;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddFeatureLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    public Feature $feature;

    public string $eventType;

    public array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Feature $feature, string $eventType, array $data)
    {
        $this->user = $user;
        $this->feature = $feature;
        $this->eventType = $eventType;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = new Feature\FeatureEvent();
        $event->user_id = $this->user->id;
        $event->feature_id = $this->feature->id;
        $event->type = $this->eventType;
        $event->description = "";
        $event->raw = json_encode($this->data);
        $event->save();
    }
}
