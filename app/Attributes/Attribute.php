<?php

namespace App\Attributes;


class Attribute
{
    private $attribute;
    private $classAttribute;

    public function __construct($attribute, $classAttribute = null)
    {
        $this->attribute = $attribute;
        $this->classAttribute = $classAttribute;
    }

    public function renderEdit($locale)
    {
        $data = array();
        $data["attribute"] = $this->attribute;
        $data["locale"] = $locale;

        return view("admin/attributes/" . $this->classAttribute->type->named_identifier . "_edit", $data);
    }

    public function renderConfiguration()
    {
        if( ! isset($this->configuration) ){
            return;
        }

        $data = array();
        $data["attribute"] = $this->attribute;

        return view("admin/attributes/" . $this->classAttribute->type->named_identifier . "_config", $data);
    }
}