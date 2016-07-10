<?php

namespace App;

use Auth;

class PermissionHelper
{
    public static function allowed($permission)
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return (bool) $group->$permission;
    }

    public static function entryNodeId()
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return $group->entry_node_id;
    }

    public static function allowedClass($classId)
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return in_array($classId, $group->allowed_classes) || in_array('all', $group->allowed_classes);
    }
}
