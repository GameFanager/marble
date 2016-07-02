<?php
namespace App\Http\Controllers;

use App\Node;
use App\NodeClassAttribute;
use App\ClassAttribute;
use App\Language;
use App\NodeTranslation;
use App\NodeClass;
use app\NodeHelper;
use DB;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function viewNode($id, $languageId)
    {
        $node = Node::find($id);
        dump($node->name);
        die();
    }

    public function redirectLocale()
    {
        $language = Language::find(Config::get("app.locale_id"));
        return redirect("/" . $language->code . "/");
    }

    public function viewIndexForLocale($language)
    {
        $node = NodeHelper::getSystemNode("settings");
        $frontpageNodeId = $node->attributes->frontpage->value[$language->id];

        if( ! $frontpageNodeId ){
            die("No Frontpage selected for locale '" . $language->code . "'");
        }

        return $this->viewNode($frontpageNodeId, $language->id);
    }
}