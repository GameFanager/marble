<?php

namespace App;

use Config;

class TreeHelper{
    public static function generate()
    {
        return self::getChildren(Config::get("app.entry_node_id"));
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