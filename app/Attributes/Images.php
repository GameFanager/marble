<?php

namespace App\Attributes;

use Request;
use Storage;
use File;

class Images extends Attribute
{
    public function processValue($oldValue, $newValue, $nodeClassAttribute, $languageId)
    {
        
        if( $newValue !== "noop" ){
            $keys = explode(",", $newValue);
            foreach($keys as $key){
                Storage::delete($oldValue[$key]->filename);
                unset($oldValue[$key]);
            }
        }

        $fileKey = "file_" . $nodeClassAttribute->id . "_" . $languageId;

        if( ! $_FILES[$fileKey]["size"] ){
            return $oldValue;
        }

        $value = (object)array();

        $file = Request::file($fileKey);
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getFilename().'.'.$extension;
		Storage::put($filename,  File::get($file));

        $value->original_filename = $file->getClientOriginalName();
        $value->filename = $filename;
        $value->sizee = $file->getSize();

        $oldValue[] = $value;
        return $oldValue;
    }
}