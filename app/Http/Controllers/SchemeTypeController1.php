<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchemeTypeMaster;

class SchemeTypeController1 extends Controller
{

    public function getSchemeTypeMaster(){
        $SchemeTypeMaster = SchemeTypeMaster::all();
        return $SchemeTypeMaster;
    }

    public function getSchemeTypeMasterById($id){
        $SchemeTypeMaster = SchemeTypeMaster::where('id', $id)->first();
        return $SchemeTypeMaster;
    }

    public function create(Request $request) {
        $is_scheme_name = SchemeTypeMaster::where('name',$request->scheme_name)->count();
        $is_scheme_name_hit_limits = SchemeTypeMaster::where('name',$request->scheme_name)->where('hit_limits',$request->hit_limits)->count();
    	if($is_scheme_name!=0) {
            return response()->json(['warning','Duplicate entery for scheme name']);
        } else if($is_scheme_name_hit_limits!=0) {
            return response()->json(['warning','Duplicate entery for scheme name and hit limits']);
        }
        else {
            $scheme_type = new SchemeTypeMaster;
        	$scheme_type->name = $request->scheme_name;
        	$scheme_type->hit_limits = $request->hit_limits;
            if($scheme_type->save())
        		return response()->json(['success','Scheme type added successful'], 200);
        	else
        		return response()->json(['error','Scheme type add failed'], 401);
        }
    }


    public function update(Request $request) {
        $scheme_type = SchemeTypeMaster::where('id',$request->id)->first();
        $scheme_type->name = $request->scheme_name;
        $scheme_type->hit_limits = $request->hit_limits;
        if($scheme_type->save())
            return response()->json(['success','Scheme type updated successful'], 200);
        else
            return response()->json(['error','Scheme type add failed'], 401);
    }

    public function delete($id) {
        $scheme_type = SchemeTypeMaster::where('id',$id)->first();
        $scheme_type->delete();
        return response()->json(['success','Scheme type deleted successful'], 200);
    }
}
