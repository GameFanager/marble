<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeClass extends Model
{
    protected $table = 'node_class';
    
    public function getAttributesAttribute(){
        
        $classAttributes = ClassAttribute::where(array("class_id" => $this->id))->get()->sortBy(function($nodeClass){

            $primarySortKey = $nodeClass->group_id;

            if( $primarySortKey != 0 ){
                $classAttributeGroup = ClassAttributeGroup::find($nodeClass->group_id);
                $primarySortKey = $classAttributeGroup->sort_order;
            }else{
                $primarySortKey = 9999;
            }

            $secondarySortKey = $nodeClass->sort_order;

            if( $secondarySortKey == -1 ){
                $secondarySortKey = "00";
            }

            $sort = implode(array($primarySortKey, "_", $secondarySortKey));
            
            return $sort;
        });
        
        $attributes = array();
        
        foreach($classAttributes as $classAttribute){
            $attribute = Attribute::find($classAttribute->attribute_id)->first();
            
            $classAttribute->type = $attribute;
            $attributes[] = $classAttribute;
        }
        
        return $attributes;
    }
}
