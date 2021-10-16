<?php

namespace App\Models;

use App\Models\Feature\FeatureApplication;
use App\Models\Feature\FeatureApplicationDevo;
use App\Models\Feature\FeatureOverride;
use App\Models\Feature\FeatureTreatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $user_id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $type
 *
 * @property User $user
 * @property FeatureTreatment[]|Collection $treatments
 * @property FeatureApplication[]|Collection $applications
 * @property FeatureApplicationDevo[]|Collection $devoApplications
 * @property FeatureOverride[]|Collection $overrides
 */
class Feature extends EloquentModel
{
    use SoftDeletes;

    protected $table = 'features';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function treatments()
    {
        return $this->hasMany(FeatureTreatment::class, 'feature_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(FeatureApplication::class, 'feature_id', 'id');
    }

    public function devoApplications()
    {
        return $this->hasMany(FeatureApplicationDevo::class, 'feature_id', 'id');
    }

    public function overrides()
    {
        return $this->hasMany(FeatureOverride::class, 'feature_id', 'id');
    }
}
