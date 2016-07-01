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
}
