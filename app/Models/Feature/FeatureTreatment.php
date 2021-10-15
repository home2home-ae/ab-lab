<?php

namespace App\Models\Feature;

use App\Models\EloquentModel;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $feature_id
 * @property string $name
 * @property string $description
 * @property string $image
 *
 * @property Feature $feature
 */
class FeatureTreatment extends EloquentModel
{
    protected $table = 'feature_treatments';

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }

    public function applications()
    {
        return $this->belongsToMany(FeatureApplication::class, 'feature_application_treatments', 'feature_treatment_id', 'feature_application_id')
            ->withPivot('allocation', 'created_at');
    }

    public function devoApplications()
    {
        return $this->belongsToMany(FeatureApplicationDevo::class, 'feature_applications_treatments_devo', 'feature_treatment_id', 'feature_application_id')
            ->withPivot('allocation', 'created_at');
    }

    public function updateProdApplication(Feature $feature)
    {
        if ($feature->applications()->count() === 0) {
            return;
        }

        foreach ($feature->applications as $application){
            $application->addTreatments($feature);
        }
    }

    public function updateDevoApplication(Feature $feature)
    {
        if ($feature->devoApplications()->count() === 0) {
            return;
        }

        foreach ($feature->devoApplications as $application){
            $application->addTreatments($feature);
        }
    }
}
