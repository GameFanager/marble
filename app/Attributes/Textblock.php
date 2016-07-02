<?php

namespace App\Attributes;


class Textblock
{
    private $attribute;

    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    public function renderEdit($locale)
    {
        $data = array();
        $data["attribute"] = $this->attribute;
        $data["locale"] = $locale;

        return view("admin/attributes/textblock", $data);
    }
}