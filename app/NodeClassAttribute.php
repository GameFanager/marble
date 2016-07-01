<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeClassAttribute extends Model
{
    protected $table = 'node_class_attribute';
    public $timestamps = false;

    private $_classAttribute;
    private $_class;

    public function setClassAttributeAttribute($value)
    {
        $this->_classAttribute = $value;
    }

    public function getClassAttributeAttribute()
    {
        return $this->_classAttribute;
    }

    public function setClassAttribute($value)
    {
        $this->_class = $value;
    }

    public function getClassAttribute()
    {
        return $this->_class;
    }

}
