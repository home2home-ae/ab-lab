<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $user_id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $type
 *
 * @property User $user
 */
class Feature extends EloquentModel
{
    use SoftDeletes;

    protected $table = 'features';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
