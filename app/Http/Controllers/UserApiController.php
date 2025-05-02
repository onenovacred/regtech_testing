<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Models\ApiGroup;
use App\Models\ApiMaster;
use App\Models\UserSchemeMaster;
use App\Models\DemoUserSchemeMaster;
use App\Models\SchemeTypeMaster;
use Illuminate\Support\Facades\Schema;
use Mail;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;

class UserApiController extends Controller
{
    public function scheme_types()
    {
        $scheme_types = SchemeTypeMaster::all();
        if (isset($scheme_types[0]) && $scheme_types[0] != null) {
            return response()->json(['scheme_types' => $scheme_types, 'status_code' => 200]);
        }
        return response()->json(['message' => 'Record not found.', 'status_code' => 102]);
    }
    public function apimenu($group)
    {
        $apimaster_submenu = DB::table('api_master')->where('api_group_id', $group)->get();
        if (isset($apimaster_submenu[0]) && $apimaster_submenu[0] != null) {
            return response()->json(['apimaster_submenu' => $apimaster_submenu, 'status_code' => 200]);
        }
        return response()->json(['message' => 'Record not found.', 'status_code' => 102]);
    }
    public function users()
    {
        $users = User::where('role_id', 1)->get();
        if (isset($users[0]) && $users[0] != null) {
            return response()->json(['users' => $users, 'status_code' => 200]);
        }
        return response()->json(['message' => 'Record not found.', 'status_code' => 102]);
    }
    public function admin_user()
    {
        $admin_users = User::where('role_id', 0)->first();
        if (isset($admin_users) && $admin_users != null) {
            return response()->json(['data' => $admin_users, 'status_code' => 200]);
        }
        return response()->json(['message' => 'Record not found.', 'status_code' => 102]);
    }
   
}
