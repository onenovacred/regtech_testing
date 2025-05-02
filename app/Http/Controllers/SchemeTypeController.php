<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchemeTypeMaster;

class SchemeTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        /* meaning of these is select 'scheme_master.*',(select count(*) from 'users'
        where 'scheme_master'.'id' = 'users'.'scheme_type_id') as 'users_count' from 'scheme_master' */ 
    	$scheme_types = SchemeTypeMaster::withCount('users')->get();
         return view('scheme_type.list', compact('scheme_types'));
    }

    public function add() {
        $scheme_types = SchemeTypeMaster::all();
        return view('scheme_type.add', compact('scheme_types'));
    }

    public function create(Request $request) {
        $is_scheme_name = SchemeTypeMaster::where('name',$request->scheme_name)->count();
        $is_scheme_name_hit_limits = SchemeTypeMaster::where('name',$request->scheme_name)->where('hit_limits',$request->hit_limits)->count();
    	if($is_scheme_name!=0) {
            return back()->with('warning','Duplicate entery for scheme name');
        } else if($is_scheme_name_hit_limits!=0) {
            return back()->with('warning','Duplicate entery for scheme name and hit limits');
        }
        else {
            $scheme_type = new SchemeTypeMaster;
        	$scheme_type->name = $request->scheme_name;
        	$scheme_type->hit_limits = $request->hit_limits;
            if($scheme_type->save())
        		return redirect()->route('scheme_type.list')->with('success','Scheme type added successful');
        	else
        		return redirect()->route('scheme_type.list')->with('error','Scheme type add failed');
        }
    }

    public function edit($id) {
        $scheme_type = SchemeTypeMaster::where('id',$id)->first();
        return view('scheme_type.edit', compact('scheme_type'));
    }

    public function update(Request $request) {
        $scheme_type = SchemeTypeMaster::where('id',$request->id)->first();
        $scheme_type->name = $request->scheme_name;
        $scheme_type->hit_limits = $request->hit_limits;
        if($scheme_type->save())
            return redirect()->route('scheme_type.list')->with('success','Scheme type updated successful');
        else
            return redirect()->route('scheme_type.list')->with('error','Scheme type add failed');
    }

    public function delete($id) {
        $scheme_type = SchemeTypeMaster::where('id',$id)->first();
        $scheme_type->delete();
        return redirect()->route('scheme_type.list')->with('success','Scheme type deleted successful');
    }
}
