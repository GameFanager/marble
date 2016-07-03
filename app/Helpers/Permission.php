<?php

namespace App;

use Config;
use App\User;
use App\UserGroup;

class PermissionHelper{

    public static function allowed($permission)
    {
        $user = User::find(1);
        $group = UserGroup::find($user->group_id);

        return !! $group->$permission;
    }
}