<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $detail
 * @property string $icon
 * @property string $type
 */
class Application extends EloquentModel
{
    protected $table = 'applications';

    protected $fillable = [
        'name', 'detail', 'icon', 'type'
    ];
}
