<?php

namespace App\Models\Feature\Application;

use App\Models\EloquentModel;
use App\Models\Feature\FeatureApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $feature_application_id
 * @property int $feature_treatment_id
 *
 * @property int $allocation
 *
 * @property FeatureApplication $application
 * @property \App\Models\Feature\FeatureTreatment $treatment
 */
class FeatureApplicationTreatmentDevo extends EloquentModel
{
    protected $table = 'feature_applications_treatments_devo';

    public function application()
    {
        return $this->belongsTo(FeatureApplication::class, 'feature_application_id', 'id');
    }

    public function teatment()
    {
        return $this->belongsTo(\App\Models\Feature\FeatureTreatment::class, 'feature_treatment_id', 'id');
    }
}
