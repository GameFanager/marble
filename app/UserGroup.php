<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserGroup extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'user_group';

    public function getAllowedClassesAttribute()
    {
        return unserialize($this->attributes["allowed_classes"]);
    }

    public function setAllowedClassesAttribute($value)
    {
         $this->attributes["allowed_classes"] = serialize($value);
    }
}
