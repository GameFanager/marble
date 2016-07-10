<?php

namespace App\Attributes;

use Request;
use Storage;
use File;
use App\NodeTranslation;

class Image extends Attribute
{
    public function processValue($oldValue, $newValue, $nodeClassAttribute, $languageId)
    {
        $key = 'file_'.$nodeClassAttribute->id.'_'.$languageId;

        if ($newValue !== 'noop') {
            Storage::delete($oldValue->filename);

            if ( ! $_FILES[$key]['size'] ) {
                return $newValue;
            }
        }

        if ( ! $_FILES[$key]['size'] ) {
            return $oldValue;
        }

        $value = (object) array();

        $file = Request::file($key);
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getFilename() . '.' . $extension;

        Storage::put($filename,  File::get($file));

        $value->original_filename = $file->getClientOriginalName();
        $value->filename = $filename;
        $value->size = $file->getSize();
        $value->transformations = (object)array();

        return $value;
    }

    public function ajaxEndpoint($request, $languageId)
    {
        if( $request->input("method") == "saveTransformations" ){

             $translation = NodeTranslation::where(
                array(
                    "node_class_attribute_id" => $this->attribute->id,
                    "language_id" => $languageId
                )
            )->get()->first();

            $value = unserialize($translation->value);
            $value->transformations = (object)$request->input("data");

            foreach($value->transformations as &$transformation){
                $transformation = (int)$transformation;
            }

            $translation->value = serialize($value);
            $translation->save();

        }
       
        die;
    }
}
