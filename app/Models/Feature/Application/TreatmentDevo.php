<?php

namespace App\Models\Feature\Application;

use App\Models\EloquentModel;
use App\Models\Feature\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $feature_application_id
 * @property int $feature_treatment_id
 *
 * @property int $allocation
 *
 * @property Application $application
 * @property \App\Models\Feature\Treatment $treatment
 */
class TreatmentDevo extends EloquentModel
{
    protected $table = 'feature_applications_treatments_devo';

    public function application()
    {
        return $this->belongsTo(Application::class, 'feature_application_id', 'id');
    }

    public function teatment()
    {
        return $this->belongsTo(\App\Models\Feature\Treatment::class, 'feature_treatment_id', 'id');
    }
}
