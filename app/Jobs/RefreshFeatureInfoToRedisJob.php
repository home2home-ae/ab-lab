<?php

namespace App\Jobs;

use ABLab\Accessor\Data\ApplicationStage;
use App\Data\FeatureApplicationStatus;
use App\Models\Feature;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class RefreshFeatureInfoToRedisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Feature $feature;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        $data = [
            'id' => $this->feature->id,
            'name' => $this->feature->name,
            'type' => $this->feature->type,
        ];

        $data['applications'] = [
            ApplicationStage::DEVELOPMENT => $this->getDevoApplications(),
            ApplicationStage::PRODUCTION => $this->getApplications(),
        ];

        $data['overrides'] = $this->getFeatureOverride();

        print("\r\n");
        print(json_encode($data));
        print("\r\n");

        Redis::set($this->feature->name, json_encode($data));
    }

    public function getApplications()
    {
        return $this->feature->applications()
            ->whereNotIn('status', [
                FeatureApplicationStatus::OFF,
                FeatureApplicationStatus::PAUSED,
            ])
            ->get()
            ->map(function (Feature\FeatureApplication $application) {
                return [
                    'id' => $application->id,
                    'unique_id' => $application->application->unique_id,
                    'name' => $application->application->name,
                    'status' => $application->status,
                    'treatments' => $this->getApplicationTreatments($application),
                    'are_overrides_active' => $application->are_overrides_active
                ];
            })->toArray();
    }

    public function getDevoApplications()
    {
        return $this->feature->devoApplications()
            ->whereNotIn('status', [
                FeatureApplicationStatus::OFF,
                FeatureApplicationStatus::PAUSED,
            ])
            ->get()
            ->map(function (Feature\FeatureApplicationDevo $application) {
                return [
                    'id' => $application->id,
                    'unique_id' => $application->application->unique_id,
                    'name' => $application->application->name,
                    'status' => $application->status,
                    'treatments' => $this->getDevoApplicationTreatments($application),
                    'are_overrides_active' => $application->are_overrides_active
                ];
            })->toArray();
    }

    public function getApplicationTreatments(Feature\FeatureApplication $application)
    {
        return $application->treatments()->get()
            ->map(function (Feature\FeatureTreatment $featureTreatment) {
                return [
                    'id' => $featureTreatment->id,
                    'name' => $featureTreatment->name,
                    'allocation' => intval($featureTreatment->pivot->allocation)
                ];
            })
            ->toArray();
    }

    public function getDevoApplicationTreatments(Feature\FeatureApplicationDevo $application)
    {
        return $application->treatments()->get()
            ->map(function (Feature\FeatureTreatment $featureTreatment) {
                return [
                    'id' => $featureTreatment->id,
                    'name' => $featureTreatment->name,
                    'allocation' => intval($featureTreatment->pivot->allocation)
                ];
            })
            ->toArray();
    }

    public function getFeatureOverride()
    {
        return $this->feature->overrides()->get()
            ->map(function (Feature\FeatureOverride $override) {
                return [
                    'id' => $override->value,
                    'treatment' => $override->treatment->name
                ];
            })->toArray();
    }
}
