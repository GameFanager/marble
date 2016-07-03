<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\UserGroup;
use Illuminate\Hashing\BcryptHasher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listGroups()
    {
        $data = array();

        $data["groups"] = UserGroup::all();

        return view("/admin/usergroup/list", $data);
    }

    public function addGroup()
    {
        $user = new UserGroup;
        $user->name = "Neue Gruppe";
        $user->save();

        return redirect("/admin/usergroup/edit/" . $user->id);
    }

    public function editGroup($id)
    {
        $data = array();
        $data["group"] = UserGroup::find($id);

        return view("/admin/usergroup/edit", $data);
    }

    public function saveGroup(Request $request, $id)
    {
        $group = UserGroup::find($id);
        $group->name = $request->input("name");
        $group->create_user = $request->input("create_user");
        $group->create_group = $request->input("create_group");
        $group->create_class = $request->input("create_class");

        $group->delete_user = $request->input("delete_user");
        $group->delete_group = $request->input("delete_group");
        $group->delete_class = $request->input("delete_class");

        $group->edit_user = $request->input("edit_user");
        $group->edit_group = $request->input("edit_group");
        $group->edit_class = $request->input("edit_class");


        $group->list_user = $request->input("list_user");
        $group->list_group = $request->input("list_group");
        $group->list_class = $request->input("list_class");
        $group->save();

        return redirect("/admin/usergroup/edit/" . $id);
    }

    public function deleteGroup($id)
    {

        UserGroup::destroy($id);

        return redirect("/admin/usergroup/list");
    }

}