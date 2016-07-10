<?php

namespace App\Attributes;

use Request;
use Storage;
use File;

class Image extends Attribute
{
    public function processValue($oldValue, $newValue, $nodeClassAttribute, $languageId)
    {
        $key = 'file_'.$nodeClassAttribute->id.'_'.$languageId;

        if ($newValue !== 'noop') {
            Storage::delete($oldValue->filename);

            return $newValue;
        }

        // No new image uploaded, so return current image data
        if (!$_FILES[$key]['size']) {
            return $oldValue;
        }

        $value = (object) array();

        $file = Request::file($key);
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getFilename().'.'.$extension;
        Storage::put($filename,  File::get($file));

        $value->original_filename = $file->getClientOriginalName();
        $value->filename = $filename;
        $value->sizee = $file->getSize();

        return $value;
    }
}
