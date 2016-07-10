<?php

namespace App\Attributes;

use App\Node;

class ObjectRelation extends Attribute
{
    public function getValues($values)
    {
        foreach ($values as $languageId => &$value) {
            $value = Node::find($value);
        }

        return $values;
    }
}
