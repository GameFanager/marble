<?php

namespace App;

use Config;
use App\PermissionHelper;

class TreeHelper{
    private static $tree = array();

    public static function generate($forcedEntryNodeId = null)
    {

        if( $forcedEntryNodeId !== null ){
            $entryNodeId = $forcedEntryNodeId;
        }else{
            $entryNodeId = PermissionHelper::entryNodeId();
        }


        if( isset(self::$tree[$entryNodeId]) ){
            return self::$tree[$entryNodeId];
        }

        if( $entryNodeId === -1 ){
            $entryNodeId = Config::get("app.entry_node_id");
        }

        self::$tree[$entryNodeId] = self::getChildren($entryNodeId);

        return self::$tree[$entryNodeId];
    }

    private static function getChildren($parentId)
    {
        $children = array();
        $allChildren = Node::where(array("parent_id" => $parentId))->get()->sortBy(function($node){
            return $node->sort_order;
        });

        foreach($allChildren as $child){
            if( PermissionHelper::allowedClass($child->class->id) ){
                $child->children = self::getChildren($child->id);
                $children[] = $child;
            }
        }

        return $children;
    }
}