<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassAttribute extends Model
{
    protected $table = 'class_attribute';
    public $timestamps = false;

    public function getTypeAttribute()
    {
        return Attribute::find($this->attribute_id);
    }

    public function getClassAttribute()
    {
        $classNameParts = explode("_", $this->type->named_identifier);
        $className = '\App\Attributes\\';

        foreach($classNameParts as $classNamePart){
            $className .= ucfirst($classNamePart);
        }

        return new $className(null, $this);
    }

    public function getConfigurationAttribute()
    {
        if($this->attributes["configuration"]){
            return unserialize($this->attributes["configuration"]);
        }
    }

    public function setConfigurationAttribute($value)
    {
        $this->attributes["configuration"] = serialize($value);
    }
}
