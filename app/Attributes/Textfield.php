<?php

namespace App\Attributes;


class Textfield
{
    private $attribute;

    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    public function renderEdit()
    {
        $data = array();
        $data["attribute"] = $this->attribute;

        return view("admin/attributes/textfield", $data);
    }
}