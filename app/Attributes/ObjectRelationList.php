<?php

namespace App\Attributes;

use App\Node;

class ObjectRelationList extends Attribute
{
    public function getValues($values)
    {
        foreach($values as $languageId => &$value){
            foreach($value as &$node){
                $node = Node::find($node);
            }
        }

        return $values;
    }
}