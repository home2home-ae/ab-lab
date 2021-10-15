<?php

namespace App\Models\Feature;

use App\Models\EloquentModel;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $feature_id
 * @property string $value
 * @property int $feature_treatment_id
 *
 * @property Feature $feature
 * @property FeatureTreatment $treatment
 */
class FeatureOverride extends EloquentModel
{
    protected $table = 'feature_overrides';

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }

    public function treatment()
    {
        return $this->belongsTo(FeatureTreatment::class, 'feature_treatment_id', 'id');
    }
}
