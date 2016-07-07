<?php

namespace App;

use Config;

class TreeHelper{
    public static function generate()
    {

        // Auth::user not instantiated at this point...
        $entryNodeId = 1; //PermissionHelper::entryNodeId();

        if( ! $entryNodeId ){
            $entryNodeId = Config::get("app.entry_node_id");
        }

        return self::getChildren($entryNodeId);
    }

    private static function getChildren($parentId)
    {
        $children = Node::where(array("parent_id" => $parentId))->get()->sortBy(function($node){
            return $node->sort_order;
        });

        foreach($children as &$child){
            $child->children = self::getChildren($child->id);
        }

        return $children;
    }
}