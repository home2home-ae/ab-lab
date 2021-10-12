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
class Treatment extends EloquentModel
{
    protected $table = 'feature_treatments';

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }
}
