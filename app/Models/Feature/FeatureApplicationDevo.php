<?php

namespace App\Models\Feature;

use App\Models\EloquentModel;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $feature_id
 * @property int $application_id
 * @property string $status
 *
 * @property Feature $feature
 * @property \App\Models\Application $application
 * @property Feature\Application\FeatureApplicationTreatmentDevo[] $treatments
 */
class FeatureApplicationDevo extends EloquentModel
{
    protected $table = 'feature_applications_devo';

    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'application_id', 'id');
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }

    public function treatments()
    {
        return $this->belongsToMany(FeatureTreatment::class, 'feature_applications_treatments_devo', 'feature_application_id', 'feature_treatment_id')
            ->withPivot('allocation', 'created_at');
    }

    public function addTreatments(Feature $feature)
    {
        foreach ($feature->treatments as $treatment) {

            $featureApplicationTreatment = Feature\Application\FeatureApplicationTreatmentDevo::query()
                ->where('feature_application_id', $this->id)
                ->where('feature_treatment_id', $treatment->id)
                ->first();

            if ($featureApplicationTreatment) {
                continue;
            }

            $featureApplicationTreatment = new Feature\Application\FeatureApplicationTreatmentDevo();
            $featureApplicationTreatment->feature_application_id = $this->id;
            $featureApplicationTreatment->feature_treatment_id = $treatment->id;
            $featureApplicationTreatment->allocation = 0;
            $featureApplicationTreatment->save();
        }
    }
}
