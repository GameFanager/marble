<?php
namespace App\Http\Controllers\Admin;

use App\Node;
use App\NodeClassAttribute;
use App\ClassAttributeGroup;
use App\ClassAttribute;
use App\Language;
use App\NodeTranslation;
use App\NodeClass;
use DB;
use Config;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editNode($id)
    {
        $node = Node::find($id);
        $languages = Language::all();

        $data = array();

        $data["node"] = $node;
        $data["groupedNodeAttributes"] = array();

        foreach($node->attributes as $nodeAttribute){
            $groupId = $nodeAttribute->classAttribute->group_id;
            $classAttributeGroup = ClassAttributeGroup::find($groupId);
            $sortKey = $classAttributeGroup ? $classAttributeGroup->sort_order : 9999;

            if( ! isset($data["groupedNodeAttributes"][$sortKey]) ){
                $data["groupedNodeAttributes"][$sortKey] = (object)array(
                    "group" => $classAttributeGroup,
                    "items" => array()
                );
            }

            $data["groupedNodeAttributes"][$sortKey]->items[] = $nodeAttribute;
        }

        ksort($data["groupedNodeAttributes"]);

        $data["languages"] = $languages;

        if($node->class->list_children){
            $data["childNodes"] = Node::where(array("parent_id" => $id))->get()->sortBy(function($node){
                return $node->sort_order;
            });
        }

        return view('admin/node/edit', $data);
    }

    public function sortNodes(Request $request)
    {

        $nodes = $request->input("nodes");
        
        foreach($nodes as $nodeId => $sortOrder){
            $node = Node::find($nodeId);
            $node->sort_order = $sortOrder;
            $node->save();
        }
        die;
    }

    public function deleteNode($id)
    {

        $node = Node::find($id);
        $parentId = $node->parent_id;

        $this->deleteNodeAndChildNodes($id);

        return redirect("/admin/node/edit/" . $parentId);
    }

    private function deleteNodeAndChildNodes($id)
    {
        Node::destroy($id);

        $nodeClassAttributes = NodeClassAttribute::where(array("node_id" => $id))->get();
        foreach($nodeClassAttributes as $nodeClassAttribute)
            NodeClassAttribute::destroy($nodeClassAttribute->id);

        $nodeTranslations = NodeTranslation::where(array("node_id" => $id))->get();
        foreach($nodeTranslations as $nodeTranslation)
            NodeTranslation::destroy($nodeTranslation->id);

        $childNodes = Node::where(array("parent_id" => $id))->get();

        foreach($childNodes as $childNode){
            $this->deleteNodeAndChildNodes($childNode->id);
        }
    }

    public function addNode($id)
    {
        $data = array();

        $parentNode = Node::find($id);
        $nodeClasses = NodeClass::all();

        $data["parentNode"] = $parentNode;
        $data["nodeClasses"] = $nodeClasses;

        return view("admin/node/add", $data);
    }

    public function saveAddedNode(Request $request, $id)
    {
        $languages = Language::all();

        $node = new Node;
        $node->parent_id = $id;
        $node->class_id = $request->input("class_id");
        $node->save();

        $classAttributes = ClassAttribute::where(array(
            "class_id" => $node->class_id
        ))->get();

        foreach($classAttributes as $classAttribute){

            $nodeClassAttribute = new NodeClassAttribute;
            $nodeClassAttribute->node_id = $node->id;
            $nodeClassAttribute->class_attribute_id = $classAttribute->id;
            $nodeClassAttribute->save();

            foreach($languages as $language){
                $nodeTranslation = new NodeTranslation;
                $nodeTranslation->node_id = $node->id;
                $nodeTranslation->language_id = $language->id;
                $nodeTranslation->node_class_attribute_id = $nodeClassAttribute->id;

                if($classAttribute->named_identifier == "name"){
                    $nodeTranslation->value = $request->input("name");
                }else{
                    $nodeTranslation->value = $classAttribute->type->default_value;
                }

                $nodeTranslation->save();
                
            }
        }

        return redirect("/admin/node/edit/" . $node->id);
    }
    
    public function saveNode(Request $request, $id)
    {
        $node = Node::find($id);

        $attributeValues = $request->input("attributes");
        $attributes = $node->attributes;
        
        $nodeTranslations = NodeTranslation::where(array(
            "node_id" => $id
        ))->get();

        foreach($attributeValues as $nodeClassAttributeId => $values){

            $nodeClassAttribute = NodeClassAttribute::find($nodeClassAttributeId);

            foreach($values as $languageId => $value){

                $nodeTranslation = NodeTranslation::where(array(
                    "node_id" => $id,
                    "language_id" => $languageId,
                    "node_class_attribute_id" => $nodeClassAttributeId
                ))->get()->first();

                if( ! $nodeTranslation ){
                    $nodeTranslation = new NodeTranslation;
                    $nodeTranslation->node_id = $id;
                    $nodeTranslation->language_id = $languageId;
                    $nodeTranslation->node_class_attribute_id = $nodeClassAttributeId;
                }

                if( method_exists($nodeClassAttribute->class, "processValue") ){
                    $oldValue = $nodeTranslation->value;

                    if( $nodeClassAttribute->classAttribute->type->serialized_value ){
                        $oldValue = unserialize($oldValue);
                    }

                    $value = $nodeClassAttribute->class->processValue(
                        $oldValue, 
                        $value, 
                        $nodeClassAttribute, 
                        $languageId
                    );
                }

                if( $nodeClassAttribute->classAttribute->type->serialized_value ){
                    if( $value === "" ){
                        $value = $nodeClassAttribute->classAttribute->type->default_value;
                    }else{
                        $value = serialize($value);
                    }
                }

                $nodeTranslation->value = $value;
                $nodeTranslation->save();
            }
        }

        return redirect("/admin/node/edit/" . $id);
    }
}