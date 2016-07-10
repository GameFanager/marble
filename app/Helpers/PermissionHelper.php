<?php

namespace App;

use Auth;
use Config;

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
        $entryNodeId = $group->entry_node_id;

        if ($entryNodeId === -1) {
            $entryNodeId = Config::get('app.entry_node_id');
        }

        return $entryNodeId;
    }

    public static function allowedClass($classId)
    {
        $user = Auth::user();
        $group = UserGroup::find($user->group_id);

        return in_array($classId, $group->allowed_classes) || in_array('all', $group->allowed_classes);
    }
}
