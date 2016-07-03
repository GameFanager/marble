<?php

namespace App\Http\Middleware;

use App\User;
use App\UserGroup;
use App\PermissionHelper;

use Closure;

class Permission
{
    private $permissions = array(
        "/admin/user/list" => array("list_user"),
        "/admin/user/edit" => array("edit_user"),
        "/admin/user/delete" => array("delete_user"),
        "/admin/user/add" => array("create_user"),

        "/admin/nodeclass/list" => array("list_class"),
        "/admin/nodeclass/edit" => array("edit_class"),
        "/admin/nodeclass/delete" => array("delete_class"),
        "/admin/nodeclass/add" => array("create_class"),

        "/admin/nodeclass/editgroup" => array("edit_class"),
        "/admin/nodeclass/addgroup" => array("add_class"),
        "/admin/nodeclass/deletegroup" => array("delete_class"),

        "/admin/usergroup/list" => array("list_group"),
        "/admin/usergroup/edit" => array("edit_group"),
        "/admin/usergroup/delete" => array("delete_group"),
        "/admin/usergroup/add" => array("create_group"),

    );

    public function handle($request, Closure $next)
    {   
        $route = $request->route()->getCompiled()->getStaticPrefix();
        if( ! isset($this->permissions[$route]) ){
            return $next($request);
        }

        $permissionsNeeded = $this->permissions[$route];

        $flagged = false;

        foreach($permissionsNeeded as $permission){
            if( ! PermissionHelper::allowed($permission) ){
                $flagged = true;
            }
        }

        if( $flagged ){
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }

}