<?php

namespace App;

class TreeHelper{
    public static function generate()
    {
        /*$rootNode = Node::where(array("parent_id" => 0))->get()->first();
        $rootNode->children = self::getChildren($rootNode->id);
        return $rootNode;*/
        return self::getChildren(0);
    }

    private static function getChildren($parentId)
    {
        $children = Node::where(array("parent_id" => $parentId))->get();

        foreach($children as &$child){
            $child->children = self::getChildren($child->id);
        }

        return $children;
    }
}