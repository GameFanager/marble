<?php
namespace App\Http\Controllers\Admin;

use App\NodeClass;
use App\Node;
use App\Attribute;
use App\ClassAttribute;
use App\ClassAttributeGroup;
use App\NodeClassAttribute;
use App\NodeClassGroup;
use App\NodeTranslation;
use App\Language;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodeClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listNodeClasses($id = null)
    {
        $nodeClassGroup = null;

        if( $id ){
            $nodeClasses = NodeClass::where(array("group_id" => $id))->get();
            $nodeClassGroup = NodeClassGroup::find($id);
        }else{
            $nodeClasses = NodeClass::all();
        }

        $nodeClassGroups = NodeClassGroup::all();
        
        $data = array();
        
        $data["nodeClasses"] = $nodeClasses;
        $data["nodeClassGroups"] = $nodeClassGroups;
        $data["nodeClassGroup"] = $nodeClassGroup;
        
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
        $nameClassAttribute->locked = 0;
        $nameClassAttribute->sort_order = -1;
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
        $nodeClassGroups = NodeClassGroup::all();
        
        $data = array();
        
        $data["nodeClass"] = $nodeClass;
        $data["nodeClassGroups"] = $nodeClassGroups;
        
        return view('admin/nodeclass/edit', $data);
    }
    
    public function saveNodeClass(Request $request, $id)
    {
        $nodeClass = NodeClass::find($id);
        $nodeClass->name = $request->input("name");
        $nodeClass->named_identifier = $request->input("named_identifier");
        $nodeClass->icon = $request->input("icon");
        $nodeClass->allow_children = $request->input("allow_children");
        $nodeClass->list_children = $request->input("list_children");
        $nodeClass->group_id = $request->input("group_id");
        $nodeClass->locked = $request->input("locked");
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

    public function addAttributeGroup(Request $request, $id)
    {
        $groups = ClassAttributeGroup::where(array("class_id" => $id))->get();
        
        $group = new ClassAttributeGroup;
        $group->class_id = $id;
        $group->name = $request->input("name");
        $group->sort_order = count($groups);
        $group->save();

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function deleteAttributeGroup($id, $groupId){
        $classAttributes = ClassAttribute::where(array("group_id" => $groupId))->get();
        foreach($classAttributes as $classAttribute){
            $classAttribute->group_id = 0;
            $classAttribute->save();
        }
        ClassAttributeGroup::destroy($groupId);
        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function sortAttributeGroups(Request $request, $id)
    {
        $groups = $request->input("groups");
        
        foreach($groups as $groupId => $sortOrder){
            $classAttributeGroup = ClassAttributeGroup::find($groupId);
            $classAttributeGroup->sort_order = $sortOrder;
            $classAttributeGroup->save();
        }
        die;
    }
    
    public function editAttributes($id)
    {
        $nodeClass = NodeClass::find($id);
        $attributes = Attribute::all();
        $classAttributeGroups = ClassAttributeGroup::where(array("class_id" => $id))->get()->sortBy(function($group){
            return $group->sort_order;
        });
        $data = array();
        
        $data["nodeClass"] = $nodeClass;
        $data["attributes"] = $attributes;
        $data["classAttributeGroups"] = $classAttributeGroups;

        $data["groupedClassAttributes"] = array();

        foreach($nodeClass->attributes as $attribute){
            $classAttributeGroup = ClassAttributeGroup::find($attribute->group_id);
            $sortKey = $classAttributeGroup ? $classAttributeGroup->sort_order : 9999;

            if( ! isset($data["groupedClassAttributes"][$sortKey]) ){
                $data["groupedClassAttributes"][$sortKey] = (object)array(
                    "group" => $classAttributeGroup,
                    "items" => array()
                );
            }

            $data["groupedClassAttributes"][$sortKey]->items[] = $attribute;
        }

        ksort($data["groupedClassAttributes"]);

        
        return view("/admin/nodeclass/attributes", $data);
    }

    public function addAttribute(Request $request, $id)
    {
        $classAttributes = ClassAttribute::where(array("class_id" => $id))->get();

        $classAttribute = new ClassAttribute;
        $classAttribute->name = "Neues Attribute";
        $classAttribute->class_id = $id;
        $classAttribute->attribute_id = $request->input("type");
        $classAttribute->named_identifier = "new_attribute";
        $classAttribute->sort_order = count($classAttributes);
        $classAttribute->save();

        $nodes = Node::where(array("class_id" => $id))->get();
        $languages = Language::all();

        $attribute = Attribute::find($classAttribute->attribute_id);

        foreach($nodes as $node){
            $nodeClassAttribute = new NodeClassAttribute;
            $nodeClassAttribute->node_id = $node->id;
            $nodeClassAttribute->class_attribute_id = $classAttribute->id;
            $nodeClassAttribute->save();

            foreach($languages as $language){
                $nodeTranslation = new NodeTranslation;
                $nodeTranslation->node_id = $node->id;
                $nodeTranslation->language_id = $language->id;
                $nodeTranslation->value = $attribute->default_value;
                $nodeTranslation->node_class_attribute_id = $nodeClassAttribute->id;
                $nodeTranslation->save();
            }
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function deleteAttribute($id, $attributeId)
    {
        ClassAttribute::destroy($attributeId);
        $languages = Language::all();

        $nodeClassAttributes = NodeClassAttribute::where(array("class_attribute_id" => $attributeId))->get();
        
        foreach($nodeClassAttributes as $nodeClassAttribute){

            $nodeTranslations = NodeTranslation::where(
                array(
                    "node_class_attribute_id" => $nodeClassAttribute->id
                ))->get();
            
            foreach($nodeTranslations as $nodeTranslation){
                $nodeTranslation->delete();
            }

            $nodeClassAttribute->delete();
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function saveAttributes(Request $request, $id)
    {
        $attributes = $request->input("name");
        $namedIdentifiers = $request->input("named_identifier");
        $translate = $request->input("translate");
        $locked = $request->input("locked");
        $sortOrder = $request->input("sort_order");
        $configuration = $request->input("configuration");
        $groupId = $request->input("group_id");
        
        foreach($attributes as $attributeId => $name){
            $attribute = ClassAttribute::find($attributeId);
            $attribute->name = $name;
            $attribute->named_identifier = $namedIdentifiers[$attributeId];
            $attribute->translate = isset( $translate[$attributeId] ) ? 1 : 0;
            $attribute->locked = isset( $locked[$attributeId] ) ? 1 : 0;
            $attribute->sort_order = $sortOrder[$attributeId];
            $attribute->named_identifier = $namedIdentifiers[$attributeId];
            $attribute->group_id = $groupId[$attributeId];
            
            if( isset($configuration[$attributeId]) ){
                $attribute->configuration = $configuration[$attributeId];
            }

            $attribute->save();
        }

        return redirect("/admin/nodeclass/attributes/" . $id);
    }

    public function editGroup($id)
    {
        $nodeClassGroup = NodeClassGroup::find($id);

        $data = array();
        $data["nodeClassGroup"] = $nodeClassGroup;

        return view("/admin/nodeclass/editgroup", $data);
    }

    public function saveGroup(Request $request, $id)
    {
        $nodeClassGroup = NodeClassGroup::find($id);
        $nodeClassGroup->name = $request->input("name");
        $nodeClassGroup->save();

        return redirect("/admin/nodeclass/list");
    }

    public function deleteGroup($id)
    {
        NodeClassGroup::destroy($id);

        return redirect("/admin/nodeclass/list");
    }

    public function addGroup()
    {
        $nodeClassGroup = new NodeClassGroup;
        $nodeClassGroup->name = "Neue Gruppe";
        $nodeClassGroup->save();

        return redirect("/admin/nodeclass/editgroup/" . $nodeClassGroup->id);
    }
}