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
 */
class Application extends EloquentModel
{
    protected $table = 'feature_applications';

    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'application_id', 'id');
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }
}
