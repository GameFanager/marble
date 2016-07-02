<?php

namespace App;

use Config;
use App\Node;
use App\NodeTranslation;

class NodeHelper{

    public static function getSystemNode($identifier)
    {
        $systemNodes = Node::find(Config::get("app.system_nodes_id"));
        return $systemNodes->attributes->$identifier->processedValue[Config::get("app.locale_id")];
    }
}