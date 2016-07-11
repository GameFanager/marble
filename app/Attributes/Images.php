<?php

namespace App\Attributes;

use Request;
use Storage;
use File;
use App\NodeTranslation;

class Images extends Attribute
{
    public function processValue($oldValue, $newValue, $nodeClassAttribute, $languageId)
    {
        if ($newValue !== 'noop') {
            $keys = explode(',', $newValue);
            foreach ($keys as $key) {
                Storage::delete($oldValue[$key]->filename);
                unset($oldValue[$key]);
            }
        }

        $fileKey = 'file_'.$nodeClassAttribute->id.'_'.$languageId;

        if (!$_FILES[$fileKey]['size']) {
            return $oldValue;
        }

        $value = (object) array();

        $file = Request::file($fileKey);
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getFilename().'.'.$extension;
        Storage::put($filename,  File::get($file));

        $value->original_filename = $file->getClientOriginalName();
        $value->filename = $filename;
        $value->size = $file->getSize();
        $value->transformations = (object)array();

        $oldValue[] = $value;

        return $oldValue;
    }

    public function ajaxEndpoint($request, $languageId)
    {
        $translation = NodeTranslation::where(
            array(
                "node_class_attribute_id" => $this->attribute->id,
                "language_id" => $languageId
            )
        )->get()->first();

        $images = unserialize($translation->value);
        
        if( $request->input("method") === "saveTransformations" ){

            $index = $request->input("index");

            $images[$index]->transformations = (object)$request->input("transformations");

            foreach($images[$index]->transformations as &$transformation){
                $transformation = (int)$transformation;
            }

        }

        if( $request->input("method") === "sortImages" ){

            $sortOrder = $request->input("sortOrder");
            $sortedImages = array();

            foreach($sortOrder as $index){
                $sortedImages[] = $images[$index];
            }

            $images = $sortedImages;

        }

        $translation->value = serialize($images);
        $translation->save();
       
        die;
    }
}
