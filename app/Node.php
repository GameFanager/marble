<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Node extends Model
{
    protected $table = 'node';

    public function getAttributesAttribute()
    {
        $classAttributes = ClassAttribute::where(array("class_id" => $this->class_id))->get();
        $attributes = (object)array();

        foreach($classAttributes as $classAttribute){

            $attribute = NodeClassAttribute::where(array(
                "node_id" => $this->id,
                "class_attribute_id" => $classAttribute->id
            ))->get()->first();

            $attributes->{$classAttribute->named_identifier} = $attribute;
        }

        return $attributes;
    }

    public function getClassAttribute()
    {
        return NodeClass::find($this->class_id);
    }

    public function getNameAttribute()
    {
        $attributes = $this->getAttributesAttribute();
        return $attributes->name->value[Config::get("app.locale_id")];
    }
    
}
