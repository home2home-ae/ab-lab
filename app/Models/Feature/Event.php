<?php

namespace App\Models\Feature;

use App\Models\EloquentModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $level
 * @property string $type
 * @property int $application_id
 * @property int $user_id
 * @property string $description
 */
class Event extends EloquentModel
{
    protected $table = 'feature_events';

    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'application_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
