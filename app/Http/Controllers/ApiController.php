<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiGroup;
use App\Models\ApiMaster;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$api_group = ApiGroup::all();
    	return view('api.list', compact('api_group'));
    }

    public function websitechange() { 
    	$api_group = ApiGroup::all();
    	return view('api.website');
    }

    public function uploadsite(Request $request)
    {
        $request->validate([
            'indexFile' => 'required|file|mimes:html,htm|max:5120', // max 5MB
        ]);

        $file = $request->file('indexFile');

        // Define destination path
        $destinationPath = '/var/www/html/index.html';

        try {
            // Backup old file (optional)
            if (file_exists($destinationPath)) {
                copy($destinationPath, '/var/www/html/index_backup_' . date('Ymd_His') . '.html');
            }

            // Move new file
            $file->move('/var/www/html', 'index.html');

            return back()->with('success', 'index.html replaced successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload: ' . $e->getMessage());
        }
    }


    public function add() {
        $api_group = ApiGroup::all();
        return view('api.add', compact('api_group'));
    }

    public function create(Request $request) {
        // dd($request->all());
        $is_api_master = ApiMaster::where('api_slug',$request->api_slug)->count();
    	if($is_api_master==0)
        {
            $api_master = new ApiMaster;
        	$api_master->api_name = $request->api_name;
        	$api_master->basic_price = $request->basic_price;
        	$api_master->starter_price = $request->starter_price;
        	$api_master->standard_price = $request->standard_price;
        	$api_master->advance_price = $request->advance_price;
        	$api_master->growth_price = $request->growth_price;
        	$api_master->unicorn_price = $request->unicorn_price;
            $api_master->api_group_id = $request->api_group_id;
            $api_master->route_name = $request->route_name;
        	$api_master->api_slug = $request->api_slug;
            if($api_master->save())
        		return redirect()->route('api.list')->with('success','Api added successful');
        	else
        		return redirect()->route('api.list')->with('error','Api add failed');
        }
        else
        {
            return back()->with('warning','Duplicate entery for Api slug');
        }
    }
     public function update(Request $request) {
        // dd($request->all());
       foreach ($request->txtApiId as $key => $value) {
        
            $api_master = ApiMaster::where('id',$value)->first();
            $api_master->api_name = $request->input('txtApiName'.$value);
            $api_master->basic_price = $request->input('txtBasicPrice'.$value);
            $api_master->starter_price = $request->input('txtStarterPrice'.$value);
            $api_master->standard_price = $request->input('txtStandardPrice'.$value);
            $api_master->advance_price = $request->input('txtAdvancePrice'.$value);
            $api_master->growth_price = $request->input('txtGrowthPrice'.$value);
            $api_master->unicorn_price = $request->input('txtUnicornPrice'.$value);
            $api_master->save();
        }
        return redirect()->route('api.list')->with('success','Scheme updated successful');
    }

    public function api_docs() {
    	return view('api.api_docs');
    }
   
    
}


