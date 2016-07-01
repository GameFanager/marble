<?php
namespace App\Http\Controllers\Admin;

use App\Node;
use App\NodeClassAttribute;
use App\Language;
use App\NodeTranslation;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NodeController extends Controller
{

    public function editNode($id)
    {
        $node = Node::find($id);
        $languages = Language::all();

        $data = array();

        $data["node"] = $node;
        $data["languages"] = $languages;

        return view('admin/node/edit', $data);
    }
    
    public function saveNode(Request $request, $id)
    {
        $node = Node::find($id);

        $attributeValues = $request->input("attributes");
        $attributes = $node->attributes;

        $translationAttributes = $request->input("translationAttribute");

        $nodeTranslations = NodeTranslation::where(array("node_id" => $id))->get();

        foreach($nodeTranslations as $nodeTranslation){
            $language = Language::find($nodeTranslation->language_id);
            $nodeTranslation->value = $translationAttributes[$nodeTranslation->type][$language->code];
            $nodeTranslation->save();
        }
        

        foreach($attributes as $attribute){


            if( method_exists($attribute->class, "processValue") ){
                $attribute->value = $attribute->class->processValue(
                    $attribute->value, 
                    $attributeValues[$attribute->id]
                );
            }else{
                $attribute->value = $attributeValues[$attribute->id];
            }

            $attribute->save();
        }


        return redirect("/admin/node/edit/" . $id);
    }

    public function addNode($id)
    {

    }
}