<?php
namespace App\Http\Controllers\Admin;

use App\Node;
use DB;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function editNode($id)
    {
        $nodes = Node::all();
        return view('admin/node/edit');
    }
    
    public function showNode()
    {
        die("foo");
    }
}