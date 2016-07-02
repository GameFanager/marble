<?php

namespace App;

use App\NodeHelper;
use Config;
use App\Language;
use App\Http\Controllers\FrontController;

class RouteHelper{

    public static function generate()
    {
        $rootNode = NodeHelper::getSystemNode("pages");
        $nodes = self::getChildren($rootNode->id);
        $languages = Language::all();
        $routes = array();
        $controller = new FrontController;

        foreach($languages as $language){

            $prefix = Config::get("app.uri_locale_prefix") ? "/" . $language->code . "/" : "/";
            $routes[$language->id] = array();

            self::generateRoutes($routes, $prefix, $nodes, $language);

            if( Config::get("app.uri_locale_prefix") ){
                \Route::get($prefix, function() use($controller, $language){
                    $controller->viewIndexForLocale($language);
                });
            }
        }

        foreach($routes as $languageId => $languageRoute){
            foreach($languageRoute as $nodeId => $route){
                \Route::get($route, function() use($controller, $nodeId, $languageId){
                    $controller->viewNode($nodeId, $languageId);
                });
            }
        }
    }

    private static function generateRoutes(&$routes, $prefix, $nodes, $language)
    {

        foreach($nodes as $node){

            if( ! isset($node->attributes->slug) ){
                continue;
            }

            $route = $prefix;
            $route .= $node->attributes->slug->value[$language->id];
            $routes[$language->id][$node->id] = $route;

            self::generateRoutes($routes, $route . "/", $node->children, $language);
        }
    }

    private static function getChildren($parentId)
    {
        $children = Node::where(array("parent_id" => $parentId))->get();

        foreach($children as &$child){
            $child->children = self::getChildren($child->id);
        }

        return $children;
    }
}