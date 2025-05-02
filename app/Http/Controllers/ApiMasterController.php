<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiGroup;
use App\Models\ApiMaster;
use GuzzleHttp\Client;

class ApiMasterController extends Controller
{
    public function createApiMaster(Request $request)
    {
        $is_api_master = ApiMaster::where('api_slug', $request->api_slug)->count();
        if ($is_api_master == 0) {
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
            if ($api_master->save())
                return response()->json(['success', 'Api added Successfully'], 200);
            else
                return response()->json(['error', 'API Add Failed'], 401);
        } else {
            return response()->json(['warning', 'Duplicate Entry for API Slug']);
        }
    }
    public function updateApiMaster(Request $request)
    {
        foreach ($request->txtApiId as $key => $value) {
            $api_master = ApiMaster::where('id', $value)->first();
            $api_master->api_name = $request->input('txtApiName' . $value);
            $api_master->basic_price = $request->input('txtBasicPrice' . $value);
            $api_master->starter_price = $request->input('txtStarterPrice' . $value);
            $api_master->standard_price = $request->input('txtStandardPrice' . $value);
            $api_master->advance_price = $request->input('txtAdvancePrice' . $value);
            $api_master->growth_price = $request->input('txtGrowthPrice' . $value);
            $api_master->unicorn_price = $request->input('txtUnicornPrice' . $value);
            $api_master->save();
        }
        return response()->json(['success', 'Scheme updated successful'], 200);
    }
}
