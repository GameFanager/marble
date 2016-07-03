<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Hashing\BcryptHasher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listUsers()
    {
        $data = array();

        $data["users"] = User::all();

        return view("/admin/user/list", $data);
    }

    public function addUser()
    {
        $user = new User;
        $user->name = "Neuer Benutzer";
        $user->save();

        return redirect("/admin/user/edit/" . $user->id);
    }

    public function editUser($id)
    {
        $data = array();
        $data["user"] = User::find($id);

        return view("/admin/user/edit", $data);
    }

    public function saveUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");

        if( $request->input("password") ){
            $hasher = new BcryptHasher;
            $user->password = $hasher->make($request->input("password"));
        }

        $user->save();

        return redirect("/admin/user/edit/" . $id);
    }

    public function deleteUser($id)
    {

        User::destroy($id);

        return redirect("/admin/user/list");
    }

}