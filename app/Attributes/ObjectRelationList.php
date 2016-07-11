<?php

namespace App\Attributes;

use App\Node;
use App\NodeTranslation;

class ObjectRelationList extends Attribute
{
    public function getValues($values)
    {
        foreach ($values as $languageId => &$value) {
            foreach ($value as &$node) {
                $node = Node::find($node);
            }
        }

        return $values;
    }

    public function ajaxEndpoint($request, $languageId)
    {
        $translation = NodeTranslation::where(
            array(
                "node_class_attribute_id" => $this->attribute->id,
                "language_id" => $languageId
            )
        )->get()->first();

        $nodes = unserialize($translation->value);

        if( $request->input("method") === "sort" ){

            $sortOrder = $request->input("sortOrder");
            $sortedNodes = array();

            foreach($sortOrder as $index){
                $sortedNodes[] = $nodes[$index];
            }

            $nodes = $sortedNodes;

        }

        $translation->value = serialize($nodes);
        $translation->save();
       
        die;
    }
}
