<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchemeMaster;
use App\Models\UserSchemeMaster;
use App\Models\ApiMaster;
use App\Models\User;
use App\Models\ApiGroup;
use App\Models\HitCountMaster;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth()->user()->id;
        $scheme = UserSchemeMaster::join('api_master','api_master.id','=','user_scheme_master.api_id')
        ->join('api_group','api_group.id','=','user_scheme_master.api_group_id')
        ->where('user_scheme_master.user_id','=',$id)
        ->get(['user_scheme_master.*','api_master.*']);
      
        $count = count($scheme);
       
        return view('home',compact('scheme'));
    }
}
