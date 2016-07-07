<?php
namespace App\Http\Controllers\NodeClasses;

use App\Node;
use App\NodeClassAttribute;
use App\ClassAttribute;
use App\Language;
use App\NodeTranslation;
use App\NodeClass;
use App\NodeHelper;
use App\User;

use DB;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function viewNode($id, $languageId)
    {
        $node = Node::find($id);
        dump($node->name);
        die();
    }
}