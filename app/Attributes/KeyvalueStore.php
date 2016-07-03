<?php

namespace App\Attributes;


class KeyvalueStore extends Attribute
{
    public function getValues($values)
    {
        $keyValue = array();

        foreach($values as $languageId => $rows){

            $keyValue[$languageId] = (object)array();

            if( ! is_array($rows) )
                continue;
            
            foreach($rows as $row){
                $keyValue[$languageId]->{$row["key"]} = $row["value"];
            }
        }

        return $keyValue;
    }
}