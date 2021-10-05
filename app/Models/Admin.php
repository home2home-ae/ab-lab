<?php

namespace App\Models;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $user_type
 * @property string $created_at
 * @property string $updated_at
 */
class Admin extends User
{
    protected $table = 'admins';
}
