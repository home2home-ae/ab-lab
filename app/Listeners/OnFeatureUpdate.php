<?php

namespace App\Listeners;

use App\Events\FeatureUpdate;
use App\Jobs\AddFeatureLogJob;
use App\Jobs\RefreshFeatureInfoToRedisJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class OnFeatureUpdate
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
     * @param FeatureUpdate $event
     * @return void
     */
    public function handle(FeatureUpdate $event)
    {
        // add update log
        AddFeatureLogJob::dispatch(Auth::user(), $event->feature, $event->eventType, $event->data);

        // refresh feature to redis job
        RefreshFeatureInfoToRedisJob::dispatch($event->feature);
    }
}
