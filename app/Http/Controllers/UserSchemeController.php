<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApiGroup;
use App\Models\ApiMaster;
use App\Models\UserSchemeMaster;

class UserSchemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
    	$users = User::where('role_id',1)->get();
    	return view('user_scheme.list', compact('users'));
    }

    // public function add() {
    // 	$api_master = ApiMaster::where('parent_id',0)->select('name','id')->get();
    // 	return view('scheme.add', compact('api_master'));
    // }

    // public function create(Request $request) {
    //     $scheme_master = new SchemeMaster;
    //     $scheme_master->scheme_name = $request->scheme_name;
    //     $scheme_master->scheme_price = $request->scheme_price;
    //     $scheme_master->api_id = $request->api_id;
    //     $scheme_master->save();
    //     return back()->with('success','Scheme added successful');
    // }

    public function add() {
        $users = User::where('role_id',1)->get();
        $api_group = ApiGroup::all();
        return view('user_scheme.add', compact('users','api_group'));
    }

    public function create(Request $request) {
        $ids = explode(",", $request->ids);
        foreach ($ids as $key => $value) {
            $res = explode("|", $value);
            $user = UserSchemeMaster::updateOrCreate(
                ['user_id'=>$request->user_id, 'api_id'=>$res[0]],
                ['scheme_price'=>$res[1]]
            );
        }
    	$delete_ids = explode(",", $request->delete_ids);
        // foreach ($delete_ids as $key => $value) {
            $user = UserSchemeMaster::where('user_id',$request->user_id)->whereIn('api_id',$delete_ids)->delete();
        // }
    	return back()->with('success','Scheme added successful');
    }
}
