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
        dump($node->attributes->related_items->processedValue[1][0]->name);
        die();
    }

    public function redirectLocale()
    {
        $language = Language::find(Config::get("app.locale_id"));
        return redirect("/" . $language->code . "/");
    }

    public function viewIndexForLocale($language)
    {
        die("locale: " . $language->code);
    }
}