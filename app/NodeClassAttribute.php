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
        $attribute = Attribute::find($this->classAttribute->attribute_id);

        $classNameParts = explode('_', $attribute->named_identifier);
        $className = '\App\Attributes\\';

        foreach ($classNameParts as $classNamePart) {
            $className .= ucfirst($classNamePart);
        }

        return new $className($this, $this->classAttribute);
    }

    public function getValueAttribute()
    {
        $nodeValues = array();
        $languages = Language::all();

        foreach ($languages as $language) {
            $nodeTranslation = NodeTranslation::where(array(
                'node_id' => $this->node_id,
                'node_class_attribute_id' => $this->id,
                'language_id' => $language->id,
            ))->get()->first();

            $nodeValues[$language->id] = $nodeTranslation ? $nodeTranslation->value : '';
        }

        if (!$this->classAttribute->translate) {
            $localeId = Config::get('app.locale_id');

            foreach ($languages as $language) {
                if ($language->id != $localeId) {
                    $nodeValues[$language->id] = $nodeValues[$localeId];
                }
            }
        }

        if ($this->classAttribute->type->serialized_value) {
            foreach ($nodeValues as &$nodeValue) {
                $nodeValue = unserialize($nodeValue);
            }
        }

        return $nodeValues;
    }

    public function getProcessedValueAttribute()
    {
        $nodeValues = $this->value;

        if (method_exists($this->class, 'getValues')) {
            $nodeValues = $this->class->getValues($nodeValues);
        }

        return $nodeValues;
    }
}
