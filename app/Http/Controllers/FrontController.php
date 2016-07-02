<?php
namespace App\Http\Controllers;

use App\Node;
use App\NodeClassAttribute;
use App\ClassAttribute;
use App\Language;
use App\NodeTranslation;
use App\NodeClass;
use DB;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function viewNode($id, $languageId)
    {
        $node = Node::find($id);
        die($node->attributes->content->value[$languageId]);
    }
}