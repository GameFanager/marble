<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeClass extends Model
{
    protected $table = 'node_class';
    
    public function getAttributesAttribute(){
        
        $classAttributes = ClassAttribute::where(array("class_id" => $this->id))->get()->sortBy(function($nodeClass){
            return $nodeClass->group_id . "_" . $nodeClass->sort_order;
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
