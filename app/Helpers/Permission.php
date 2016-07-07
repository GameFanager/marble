<?php

namespace App;

use Config;
use Auth;
use App\User;
use App\UserGroup;

class PermissionHelper{

    public static function allowed($permission)
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return !! $group->$permission;
    }

    public static function entryNodeId()
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return $group->entry_node_id;
    }
}