<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\NodeClass;
use App\TreeHelper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewDashboard()
    {
        $nodeTree = TreeHelper::generate();
        
        return redirect("/admin/node/edit/" . $nodeTree[0]->id);
    }

}