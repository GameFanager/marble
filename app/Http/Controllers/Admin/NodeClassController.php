<?php
namespace App\Http\Controllers\Admin;

use App\NodeClass;
use App\Node;
use App\Attribute;
use App\ClassAttribute;
use App\NodeClassAttribute;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodeClassController extends Controller
{
    
    public function listNodeClasses()
    {
        $nodeClasses = NodeClass::all();
        
        $data = array();
        
        $data["nodeClasses"] = $nodeClasses;
        
        return view('admin/nodeclass/list', $data);
    }

    public function addNodeClass()
    {
        $nodeClass = new NodeClass;
        $nodeClass->name = "Neue Klasse";
        $nodeClass->save();

        $nameClassAttribute = new ClassAttribute;
        $nameClassAttribute->class_id = $nodeClass->id;
        $nameClassAttribute->attribute_id = 1;
        $nameClassAttribute->name = "Name";
        $nameClassAttribute->named_identifier = "name";
        $nameClassAttribute->translate = 1;
        $nameClassAttribute->locked = 1;
        $nameClassAttribute->save();

        $slugClassAttribute = new ClassAttribute;
        $slugClassAttribute->class_id = $nodeClass->id;
        $slugClassAttribute->attribute_id = 1;
        $slugClassAttribute->name = "Slug";
        $slugClassAttribute->named_identifier = "slug";
        $slugClassAttribute->translate = 1;
        $slugClassAttribute->locked = 0;
        $slugClassAttribute->save();
        
        return redirect("/admin/nodeclass/edit/" . $nodeClass->id);
    }
    
    public function editNodeClass($id)
    {
        $nodeClass = NodeClass::find($id);
        
        $data = array();
        
        $data["nodeClass"] = $nodeClass;
        
        return view('admin/nodeclass/edit', $data);
    }
    
    public function saveNodeClass(Request $request, $id)
    {
        $nodeClass = NodeClass::find($id);
        $nodeClass->name = $request->input("name");
        $nodeClass->named_identifier = $request->input("named_identifier");
        $nodeClass->icon = $request->input("icon");
        $nodeClass->allow_children = $request->input("allow_children");
        $nodeClass->save();
        
        return redirect("/admin/nodeclass/list");
    }
    
    public function deleteNodeClass($id)
    {
        NodeClass::destroy($id);
        
        $classAttributes = ClassAttribute::where(array("class_id" => $id))->get();

        foreach($classAttributes as $classAttribute){
            ClassAttribute::destroy($classAttribute->id);
        }

        return redirect("/admin/nodeclass/list");
    }
    
    public function editAttributes($id)
    {
        $nodeClass = NodeClass::find($id);
        $attributes = Attribute::all();
        
        $data = array();
        
        $data["nodeClass"] = $nodeClass;
        $data["attributes"] = $attributes;
        
        return view("/admin/nodeclass/attributes", $data);
    }

    public function addAttribute(Request $request, $id)
    {
        $classAttribute = new ClassAttribute;
        $classAttribute->name = "Neues Attribute";
        $classAttribute->class_id = $id;
        $classAttribute->attribute_id = $request->input("type");
        $classAttribute->named_identifier = "new_attribute";
        $classAttribute->save();

        $nodes = Node::where(array("class_id" => $id))->get();

        $attribute = Attribute::find($classAttribute->attribute_id)->get()->first();

        foreach($nodes as $node){
            $nodeClassAttribute = new NodeClassAttribute;
            $nodeClassAttribute->node_id = $node->id;
            $nodeClassAttribute->class_attribute_id = $classAttribute->id;
            $nodeClassAttribute->value = $attribute->default_value;
            $nodeClassAttribute->save();
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function deleteAttribute($id, $attributeId)
    {
        ClassAttribute::destroy($attributeId);
        $nodeClassAttributes = NodeClassAttribute::where(array("class_attribute_id" => $attributeId))->get();
        
        foreach($nodeClassAttributes as $nodeClassAttribute){
            $nodeClassAttribute->delete();
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function saveAttributes(Request $request, $id)
    {
        $attributes = $request->input("name");
        $namedIdentifiers = $request->input("named_identifier");
        $translate = $request->input("translate");
        $sortOrder = $request->input("sort_order");
        $configuration = $request->input("configuration");
        
        foreach($attributes as $attributeId => $name){
            $attribute = ClassAttribute::find($attributeId);
            $attribute->name = $name;
            $attribute->named_identifier = $namedIdentifiers[$attributeId];
            $attribute->translate = isset( $translate[$attributeId] ) ? 1 : 0;
            $attribute->sort_order = $sortOrder[$attributeId];
            $attribute->named_identifier = $namedIdentifiers[$attributeId];
            $attribute->configuration = $configuration[$attributeId];
            $attribute->save();
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }
}