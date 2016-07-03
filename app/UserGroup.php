<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserGroup extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'user_group';
}
