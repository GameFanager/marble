<?php

namespace App\Http\Controllers\NodeClasses;

use App\Node;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function viewNode($id, $languageId)
    {
        $node = Node::find($id);
        dump($node->name);
        die();
    }
}
