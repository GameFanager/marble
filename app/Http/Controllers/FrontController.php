<?php
namespace App\Http\Controllers;

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

class FrontController extends Controller
{

    public function viewNode($id, $languageId)
    {
        $user = new User;
        $user->email = "phillip@dornauer-2.cc";
        $user->password = "fuckyou2";
        $user->name = "PD 1";
        $user->save();
        die;
        $node = Node::find($id);
        dump($node->name);
        die();
    }

    public function redirectLocale()
    {
        if( Config::get("app.uri_locale_prefix") ){
            $language = Language::find(Config::get("app.locale_id"));
            return redirect("/" . $language->code . "/");

        }else{
            return $this->viewIndexForLocale(Language::find(Config::get("app.locale_id")));
        }
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