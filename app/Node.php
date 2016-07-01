<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $table = 'node';

    public function getAttributesAttribute()
    {
        $classAttributes = ClassAttribute::where(array("class_id" => $this->class_id))->get();
        $attributes = array();

        foreach($classAttributes as &$classAttribute){

            $attribute = NodeClassAttribute::where(array(
                "node_id" => $this->id,
                "class_attribute_id" => $classAttribute->id
            ))->get()->first();

            $classAttribute->configuration = unserialize($classAttribute->configuration);
            $attribute->_classAttribute = $classAttribute;
            $classNameParts = explode("_", $classAttribute->type->named_identifier);
            $className = '\App\Attributes\\';

            foreach($classNameParts as $classNamePart){
                $className .= ucfirst($classNamePart);
            }
            $attribute->_class = new $className($attribute);
            
            $attributes[] = $attribute;
        }

        return $attributes;
    }

    private function getTranslationAttributeByType($type)
    {
        $nodeTranslations = NodeTranslation::where(
            array(
                "node_id" => $this->id, 
                "type" => $type)
            )->get();
        
        $nodeValues = array();

        foreach($nodeTranslations as $nodeTranslation){
            $language = Language::find($nodeTranslation->language_id);
            $nodeValues[$language->code] = $nodeTranslation->value;
        }
        return $nodeValues;
    }

    public function getNameAttribute()
    {
        return $this->getTranslationAttributeByType("name");
    }

    public function getSlugAttribute()
    {
        return $this->getTranslationAttributeByType("slug");
    }
    
}
