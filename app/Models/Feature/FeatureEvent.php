<?php

namespace App\Models\Feature;

use App\Models\EloquentModel;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $level
 * @property string $type
 * @property int $feature_id
 * @property int $user_id
 * @property string $description
 * @property string $raw
 *
 * @property Feature $feature
 */
class FeatureEvent extends EloquentModel
{
    protected $table = 'feature_events';

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
