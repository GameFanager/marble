<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class NodeClassAttribute extends Model
{
    protected $table = 'node_class_attribute';
    public $timestamps = false;

    public function getClassAttributeAttribute()
    {
        return ClassAttribute::find($this->class_attribute_id);
    }

    public function getClassAttribute()
    {
        $classAttribute = ClassAttribute::find($this->class_attribute_id);
        $classNameParts = explode("_", $classAttribute->type->named_identifier);
        $className = '\App\Attributes\\';

        foreach($classNameParts as $classNamePart){
            $className .= ucfirst($classNamePart);
        }

        return new $className($this);
    }

    public function getValueAttribute()
    {
        $nodeValues = array();
        $languages = Language::all();

        foreach($languages as $language){
            $nodeTranslation = NodeTranslation::where(array(
                "node_id" => $this->node_id,
                "node_class_attribute_id" => $this->id,
                "language_id" => $language->id
            ))->get()->first();
            
            $nodeValues[$language->id] = $nodeTranslation ? $nodeTranslation->value : "";
        }

        if( ! $this->_classAttribute->translate ){
            $localeId = Config::get("app.locale_id");

            foreach($languages as $language){
                if( $language->id != $localeId ){
                    $nodeValues[$language->id] = $nodeValues[$localeId];
                }
            }
        }

        return $nodeValues;
    }

}
