<?php

namespace App\Http\Controllers\Admin;

use App\PermissionHelper;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewDashboard()
    {
        $entryNodeId = PermissionHelper::entryNodeId();

        return redirect('/admin/node/edit/'.$entryNodeId);
    }
}
