<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class SearchDataController1 extends Controller
{
    public function searchall()
    {
        $cheackdata1 = DB::table('bc_registry_chunk_1');
        $cheackdata2 = DB::table('bc_registry_chunk_2');
        $cheackdata3 = DB::table('bc_registry_chunk_3');
        $cheackdata4 = DB::table('bc_registry_chunk_4');

        $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
        $cheackdata = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
            ->mergeBindings($mergeTbl)
            ->paginate(20);
        return $cheackdata;
    }


    // public function searchallData(Request $request)
    // {

    //     return $request->token;

    //     $query = $request->input('query');

    //     $cheackdata1 = DB::table('bc_registry_chunk_1');
    //     $cheackdata2 = DB::table('bc_registry_chunk_2');
    //     $cheackdata3 = DB::table('bc_registry_chunk_3');
    //     $cheackdata4 = DB::table('bc_registry_chunk_4');

    //     $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
    //     $cheackdata = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
    //         ->mergeBindings($mergeTbl)->where('BCName', 'like', '%' . $query . '%')
    //                     ->orWhere('MobileNo', 'like', '%' . $query . '%')
    //                     ->orWhere('Pincode', 'like', '%' . $query . '%')
    //                     ->orWhere('State', 'like', '%' . $query . '%')
    //                     ->orWhere('District', 'like', '%' . $query . '%')
    //               ->paginate(20);
    //     Paginator::useBootstrap();
    //     return response()->json([
    //         'results' => $cheackdata,
    //         'pagination' =>$cheackdata->links()->toHtml(),
    //     ]);
    // }

    public function searchallData(Request $request)
    {
        $token = $request->input('token');
        $user = DB::table('users')->where('access_token', $token)->first();
        if ($user->role_id != 0) {
            return response()->json([
                'message' => 'You are not allowed to get the data'
            ], 403); // Return forbidden status (HTTP 403)
        }

        // If the user is allowed (role 0), proceed with the data query
        $query = $request->input('query');

        $cheackdata1 = DB::table('bc_registry_chunk_1');
        $cheackdata2 = DB::table('bc_registry_chunk_2');
        $cheackdata3 = DB::table('bc_registry_chunk_3');
        $cheackdata4 = DB::table('bc_registry_chunk_4');

        $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);

        $cheackdata = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
            ->mergeBindings($mergeTbl)
            ->where('BCName', 'like', '%' . $query . '%')
            ->orWhere('MobileNo', 'like', '%' . $query . '%')
            ->orWhere('Pincode', 'like', '%' . $query . '%')
            ->orWhere('State', 'like', '%' . $query . '%')
            ->orWhere('District', 'like', '%' . $query . '%')
            ->paginate(20);

        // Return the results and pagination links
        Paginator::useBootstrap();
        return response()->json([
            'results' => $cheackdata,
            'pagination' => $cheackdata->links()->toHtml(),
        ]);
    }

    public function pagination(Request $request)
    {

        $cheackdata1 = DB::table('bc_registry_chunk_1');
        $cheackdata2 = DB::table('bc_registry_chunk_2');
        $cheackdata3 = DB::table('bc_registry_chunk_3');
        $cheackdata4 = DB::table('bc_registry_chunk_4');

        $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
        $cheackdata = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
            ->mergeBindings($mergeTbl)
            ->paginate(20);
        return response()->json([
            'results' => $cheackdata,
        ]);
    }

    public function downloadExcel(Request $request)
    {


        if ($request->get('mobile_no') || $request->get('district') || $request->get('b_name') || $request->get('pincode') || $request->get('state')) {
            $records = null;
            $cheackdata1 = DB::table('bc_registry_chunk_1');
            $cheackdata2 = DB::table('bc_registry_chunk_2');
            $cheackdata3 = DB::table('bc_registry_chunk_3');
            $cheackdata4 = DB::table('bc_registry_chunk_4');
            if ($request->get('mobile_no')) {
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('MobileNo', $request->mobile_no)
                    ->get();
            }
            if ($request->get('district')) {
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('District', $request->district)
                    ->get();
            }
            if ($request->get('b_name')) {
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('BCName', $request->b_name)
                    ->get();
            }
            if ($request->get('pincode')) {
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('Pincode', $request->pincode)
                    ->get();
            }
            if ($request->get('state')) {
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('State', $request->state)
                    ->get();
            }
            return response()->json($records);
        }

        $request->session()->flash('message', 'please select export option.');
    }


    // public function search(Request $request)
    // {
    //     $data = DB::table('advbdata_mumbai_66')
    // ->join('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')  // Perform the join
    // ->select('advbdata_mumbai_66.*', 'advbdata_ap_and_ts_62.id')  // Select the necessary columns
    // ->paginate(1000);   // Paginate with 1000 records per page

    // return $data;
// $data = DB::table('advbdata_mumbai_66')
//     ->join('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')  // First join
//     ->join('advbdata_mh_249', 'advbdata_mumbai_66.id', '=', 'advbdata_mh_249.id')  // Second join
//     ->select('advbdata_mumbai_66.id as advbdata_mumbai_66_id',
//     'advbdata_mumbai_66.Name as advbdata_mumbai_66_Name',
//         'advbdata_mumbai_66.PhoneNumber as advbdata_mumbai_66_PhoneNumber',
//         'advbdata_mumbai_66.StateName as advbdata_mumbai_66_StateName',
//     'advbdata_ap_and_ts_62.id as advbdata_ap_and_ts_62_id',
//     'advbdata_ap_and_ts_62.Name as advbdata_ap_and_ts_62_Name',
//     'advbdata_ap_and_ts_62.PhoneNumber as advbdata_ap_and_ts_62_PhoneNumber',
//     'advbdata_ap_and_ts_62.StateName as advbdata_ap_and_ts_62_StateName',
//     'advbdata_mh_249.id as advbdata_mh_249_id',
//     'advbdata_mh_249.Name as advbdata_mh_249_Name',
//     'advbdata_mh_249.PhoneNumber as advbdata_mh_249_PhoneNumber',
//     // 'advbdata_mh_249.StateName as advbdata_mh_249_StateName',
//     )
//     ->paginate(1000);   // Paginate with 1000 records per page

    //     return $data;
// return "hello";

    // $data = DB::table('advbdata_mumbai_66')
//     ->leftJoin('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')  // Left join instead of inner join
//     ->leftJoin('advbdata_mh_249', 'advbdata_mumbai_66.id', '=', 'advbdata_mh_249.id')  // Left join instead of inner join
//     ->select(
//         'advbdata_mumbai_66.id as advbdata_mumbai_66_id',
//         'advbdata_mumbai_66.Name as advbdata_mumbai_66_Name',
//         'advbdata_mumbai_66.PhoneNumber as advbdata_mumbai_66_PhoneNumber',
//         'advbdata_mumbai_66.StateName as advbdata_mumbai_66_StateName',
//         'advbdata_ap_and_ts_62.id as advbdata_ap_and_ts_62_id',
//         'advbdata_ap_and_ts_62.Name as advbdata_ap_and_ts_62_Name',
//         'advbdata_ap_and_ts_62.PhoneNumber as advbdata_ap_and_ts_62_PhoneNumber',
//         'advbdata_ap_and_ts_62.StateName as advbdata_ap_and_ts_62_StateName',
//         'advbdata_mh_249.id as advbdata_mh_249_id',
//         'advbdata_mh_249.Name as advbdata_mh_249_Name',
//         'advbdata_mh_249.PhoneNumber as advbdata_mh_249_PhoneNumber'
//     )
//     ->paginate(1000);  // Paginate with 1000 records per page

    // return $data;

    // $data = DB::table('advbdata_mumbai_66')
//     ->leftJoin('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')
//     ->leftJoin('advbdata_mh_249', 'advbdata_mumbai_66.id', '=', 'advbdata_mh_249.id')
//     ->select(
//         'advbdata_mumbai_66.id as advbdata_mumbai_66_id',
//         'advbdata_mumbai_66.Name as advbdata_mumbai_66_Name',
//         'advbdata_mumbai_66.PhoneNumber as advbdata_mumbai_66_PhoneNumber',
//         'advbdata_mumbai_66.StateName as advbdata_mumbai_66_StateName',
//         'advbdata_ap_and_ts_62.id as advbdata_ap_and_ts_62_id',
//         'advbdata_ap_and_ts_62.Name as advbdata_ap_and_ts_62_Name',
//         'advbdata_ap_and_ts_62.PhoneNumber as advbdata_ap_and_ts_62_PhoneNumber',
//         'advbdata_ap_and_ts_62.StateName as advbdata_ap_and_ts_62_StateName',
//         'advbdata_mh_249.id as advbdata_mh_249_id',
//         'advbdata_mh_249.Name as advbdata_mh_249_Name',
//         'advbdata_mh_249.PhoneNumber as advbdata_mh_249_PhoneNumber'
//     )
//     ->paginate(1000);

    // // Reshape the data
// $reshapedData = [];

    // // foreach ($data->items() as $item) {
//     foreach ($data->items() as $index => $item) {
//         // $index = $index+1;
//     // Flatten the data into individual objects
//     $reshapedData[] = [
//         // Mumbai 66 data
//         "advbdata_mumbai_66_id" => $item->advbdata_mumbai_66_id,
//         "advbdata_mumbai_66_Name" => $item->advbdata_mumbai_66_Name,
//         "advbdata_mumbai_66_PhoneNumber" => $item->advbdata_mumbai_66_PhoneNumber,
//         "advbdata_mumbai_66_StateName" => $item->advbdata_mumbai_66_StateName,
//     ];

    //     $reshapedData[] = [
//         // AP & TS data
//         "advbdata_ap_and_ts_62_id" => $item->advbdata_ap_and_ts_62_id,
//         "advbdata_ap_and_ts_62_Name" => $item->advbdata_ap_and_ts_62_Name,
//         "advbdata_ap_and_ts_62_PhoneNumber" => $item->advbdata_ap_and_ts_62_PhoneNumber,
//         "advbdata_ap_and_ts_62_StateName" => $item->advbdata_ap_and_ts_62_StateName,
//     ];

    //     $reshapedData[] = [
//         // MH 249 data
//         "advbdata_mh_249_id" => $item->advbdata_mh_249_id,
//         "advbdata_mh_249_Name" => $item->advbdata_mh_249_Name,
//         "advbdata_mh_249_PhoneNumber" => $item->advbdata_mh_249_PhoneNumber,
//     ];
// }

    // // Prepare the final response structure
// $response = [
//     'current_page' => $data->currentPage(),
//     'data' => $reshapedData
// ];

    // // Return the reshaped data as JSON
// return response()->json($response);

    // $data = DB::table('advbdata_mumbai_66')
//     ->leftJoin('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')
//     ->leftJoin('advbdata_mh_249', 'advbdata_mumbai_66.id', '=', 'advbdata_mh_249.id')
//     ->select(
//         'advbdata_mumbai_66.id as advbdata_mumbai_66_id',
//         'advbdata_mumbai_66.Name as advbdata_mumbai_66_Name',
//         'advbdata_mumbai_66.PhoneNumber as advbdata_mumbai_66_PhoneNumber',
//         'advbdata_mumbai_66.StateName as advbdata_mumbai_66_StateName',
//         'advbdata_ap_and_ts_62.id as advbdata_ap_and_ts_62_id',
//         'advbdata_ap_and_ts_62.Name as advbdata_ap_and_ts_62_Name',
//         'advbdata_ap_and_ts_62.PhoneNumber as advbdata_ap_and_ts_62_PhoneNumber',
//         'advbdata_ap_and_ts_62.StateName as advbdata_ap_and_ts_62_StateName',
//         'advbdata_mh_249.id as advbdata_mh_249_id',
//         'advbdata_mh_249.Name as advbdata_mh_249_Name',
//         'advbdata_mh_249.PhoneNumber as advbdata_mh_249_PhoneNumber'
//     )
//     ->paginate(1000);


    // $reshapedData = [];

    // foreach ($data->items() as $item) {
//     $reshapedData[] = [
//         "advbdata_mumbai_66_Name" => $item->advbdata_mumbai_66_Name,
//         "advbdata_mumbai_66_PhoneNumber" => $item->advbdata_mumbai_66_PhoneNumber,
//         "advbdata_mumbai_66_StateName" => $item->advbdata_mumbai_66_StateName,
//     ];

    //     $reshapedData[] = [

    //         "advbdata_ap_and_ts_62_PhoneNumber" => $item->advbdata_ap_and_ts_62_PhoneNumber,
//         "advbdata_ap_and_ts_62_StateName" => $item->advbdata_ap_and_ts_62_StateName,
//     ];

    //     $reshapedData[] = [

    //         "advbdata_mh_249_Name" => $item->advbdata_mh_249_Name,
//         "advbdata_mh_249_PhoneNumber" => $item->advbdata_mh_249_PhoneNumber,
//     ];
// }

    // foreach ($reshapedData as $index => &$item) {
//     $item['id'] = $data[0]->advbdata_mumbai_66_id + $index;
// }


    // $response = [
//     'current_page' => $data->currentPage(),
//     'data' => $reshapedData
// ];

    // return response()->json($response);

    // $data = DB::table('advbdata_mumbai_66')
//     ->leftJoin('advbdata_ap_and_ts_62', 'advbdata_mumbai_66.id', '=', 'advbdata_ap_and_ts_62.id')
//     ->leftJoin('advbdata_mh_249', 'advbdata_mumbai_66.id', '=', 'advbdata_mh_249.id')
//     ->select(
//         'advbdata_mumbai_66.id as advbdata_mumbai_66_id',
//         'advbdata_mumbai_66.Name as advbdata_mumbai_66_Name',
//         'advbdata_mumbai_66.PhoneNumber as advbdata_mumbai_66_PhoneNumber',
//         'advbdata_mumbai_66.StateName as advbdata_mumbai_66_StateName',
//         'advbdata_ap_and_ts_62.id as advbdata_ap_and_ts_62_id',
//         'advbdata_ap_and_ts_62.Name as advbdata_ap_and_ts_62_Name',
//         'advbdata_ap_and_ts_62.PhoneNumber as advbdata_ap_and_ts_62_PhoneNumber',
//         'advbdata_ap_and_ts_62.StateName as advbdata_ap_and_ts_62_StateName',
//         'advbdata_mh_249.id as advbdata_mh_249_id',
//         'advbdata_mh_249.Name as advbdata_mh_249_Name',
//         'advbdata_mh_249.PhoneNumber as advbdata_mh_249_PhoneNumber'
//     )
//     ->paginate(1000);

    // $reshapedData = [];

    // foreach ($data->items() as $item) {
//     $reshapedData[] = [
//         "advbdata_mumbai_66_Name" => $item->advbdata_mumbai_66_Name,
//         "advbdata_mumbai_66_PhoneNumber" => $item->advbdata_mumbai_66_PhoneNumber,
//         "advbdata_mumbai_66_StateName" => $item->advbdata_mumbai_66_StateName,
//     ];

    //     $reshapedData[] = [
//         "advbdata_ap_and_ts_62_PhoneNumber" => $item->advbdata_ap_and_ts_62_PhoneNumber,
//         "advbdata_ap_and_ts_62_StateName" => $item->advbdata_ap_and_ts_62_StateName,
//     ];

    //     $reshapedData[] = [
//         "advbdata_mh_249_Name" => $item->advbdata_mh_249_Name,
//         "advbdata_mh_249_PhoneNumber" => $item->advbdata_mh_249_PhoneNumber,
//     ];
// }

    // foreach ($reshapedData as $index => &$item) {
//     $item['id'] = $data->first()->advbdata_mumbai_66_id + $index; // Correcting how ID is assigned
// }

    // $response = [
//     'current_page' => $data->currentPage(),
//     'per_page' => $data->perPage(),
//     'total' => $data->total(),
//     'last_page' => $data->lastPage(),
//     'data' => $reshapedData,
// ];

    // return response()->json($response);


    // Get the current page number, default to 1 if not provided
// $page = $request->input('page', 1);
// $perPage = 3;  // Number of records per table per page

    // // Fetch records from the three tables
// // $dataMumbai = DB::table('advbdata_mumbai_66')->skip(($page - 1) * $perPage)->take($perPage)->get();
// // $dataApAndTs = DB::table('advbdata_ap_and_ts_62')->skip(($page - 1) * $perPage)->take($perPage)->get();
// // $dataMh = DB::table('advbdata_mh_249')->skip(($page - 1) * $perPage)->take($perPage)->get();

    // $dataMumbai = DB::table('advbdata_mumbai_66')
//             ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//             ->skip(($page - 1) * $perPage)
//             ->take($perPage)
//             ->get();

    //         $dataApAndTs = DB::table('advbdata_ap_and_ts_62')
//             ->select('id','Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//             ->skip(($page - 1) * $perPage)
//             ->take($perPage)
//             ->get();

    //         $dataMh = DB::table('advbdata_mh_249')
//             ->select('id', 'Name', 'PhoneNumber')  // Select only the desired columns
//             ->skip(($page - 1) * $perPage)
//             ->take($perPage)
//             ->get();

    // // Get the total record count from each table
// $countMumbai = DB::table('advbdata_mumbai_66')->count();
// $countApAndTs = DB::table('advbdata_ap_and_ts_62')->count();
// $countMh = DB::table('advbdata_mh_249')->count();

    // // Calculate total count
// $totalCount = $countMumbai + $countApAndTs + $countMh;

    // // Calculate last page (assuming we are dividing the count by 3 per table and using the same pagination logic)
// $lastPageMumbai = ceil($countMumbai / $perPage);
// $lastPageApAndTs = ceil($countApAndTs / $perPage);
// $lastPageMh = ceil($countMh / $perPage);

    // // The last page will be the highest among the three
// $lastPage = max($lastPageMumbai, $lastPageApAndTs, $lastPageMh);

    // // Combine the data into a response
// $response = [
//     'data' => [
//         'mumbai' => $dataMumbai,
//         'ap_and_ts' => $dataApAndTs,
//         'mh' => $dataMh,
//     ],
//     'count' => [
//         'mumbai_count' => $countMumbai,
//         'ap_and_ts_count' => $countApAndTs,
//         'mh_count' => $countMh,
//     ],
//     'total_count' => $totalCount,
//     'current_page' => $page,
//     'last_page' => $lastPage,
// ];

    // return response()->json($response);


    // $page = $request->input('page', 1);
// $perPage = 100;  // Number of records per table per page

    // // Fetch records from the three tables
// $dataMumbai = DB::table('advbdata_mumbai_66')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    // $dataApAndTs = DB::table('advbdata_ap_and_ts_62')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    //     $bc01 = DB::table('bc_01')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    //     $bc02 = DB::table('bc_02')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    //     $bc03 = DB::table('bc_03')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    //     $bc04 = DB::table('bc_04')
//     ->select('id', 'Name', 'PhoneNumber', 'StateName')  // Select only the desired columns
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    // $dataMh = DB::table('advbdata_mh_249')
//     ->select('id', 'Name', 'PhoneNumber')  // Select only the desired columns (no StateName)
//     ->skip(($page - 1) * $perPage)
//     ->take($perPage)
//     ->get();

    // // Get the total record count from each table
// $countMumbai = DB::table('advbdata_mumbai_66')->count();
// $countApAndTs = DB::table('advbdata_ap_and_ts_62')->count();
// $countMh = DB::table('advbdata_mh_249')->count();
// $countBc01 = DB::table('advbdata_mh_249')->count();
// $countBc02 = DB::table('advbdata_mh_249')->count();
// $countBc03 = DB::table('advbdata_mh_249')->count();
// $countBc04 = DB::table('advbdata_mh_249')->count();

    // // Calculate total count
// $totalCount = $countMumbai + $countApAndTs + $countMh + $countBc01 + $countBc02 + $countBc03 + $countBc04;

    // // Calculate last page (assuming we are dividing the count by 3 per table and using the same pagination logic)
// $lastPageMumbai = ceil($countMumbai / $perPage);
// $lastPageApAndTs = ceil($countApAndTs / $perPage);
// $lastPageMh = ceil($countMh / $perPage);
// $lastPageBc01 = ceil($countBc01 / $perPage);
// $lastPageBc02 = ceil($countBc02 / $perPage);
// $lastPageBc03 = ceil($countBc03 / $perPage);
// $lastPageBc04 = ceil($countBc04 / $perPage);

    // // The last page will be the highest among the three
// $lastPage = max($lastPageMumbai, $lastPageApAndTs, $lastPageMh, $lastPageBc01, $lastPageBc02, $lastPageBc03, $lastPageBc04);

    // // Merge the data into one array, adding StateName where it exists
// $data = array_merge(
//     $dataMumbai->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $dataApAndTs->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $bc01->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $bc02->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $bc03->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $bc04->map(function ($item) {
//         return $item;
//     })->toArray(),
//     $dataMh->map(function ($item) {
//         return $item;
//     })->toArray()
// );

    // // Assign sequential IDs to the merged data
// foreach ($data as $index => $item) {
//     $item->id = (($page - 1) * $perPage) * 7 + ($index + 1);  // Sequential ID starting from 1
// }

    // // Combine the data into a response
// $response = [
//     'data' => $data,
//     // 'count' => [
//     //     'mumbai_count' => $countMumbai,
//     //     'ap_and_ts_count' => $countApAndTs,
//     //     'mh_count' => $countMh,
//     // ],
//     'total_count' => $totalCount,
//     'current_page' => $page,
//     'last_page' => $lastPage,
// ];

    // return response()->json($response);






    // ->join('bc_02', 'bc_02.id', "=", 'bc_01.id')
    // ->get()
    // ->toArray();
    // Get current page from query parameters
    // $page = $request->input('page', 1);  // Default to page 1 if not provided
    // $perPage = 1000;  // We want 1000 records per page

    // // Calculate offset based on current page
    // $offset = ($page - 1) * $perPage;

    // // Query to join all the tables and return paginated data
    // $data = DB::table('bc_01')
    //     ->join('bc_02', 'bc_01.id', '=', 'bc_02.id')
    //     ->join('bc_03', 'bc_01.id', '=', 'bc_03.id')
    //     ->join('bigshop_01', 'bc_01.id', '=', 'bigshop_01.id')
    //     ->join('bigshop_02', 'bc_01.id', '=', 'bigshop_02.id')
    //     ->join('cinema_03', 'bc_01.id', '=', 'cinema_03.id')
    //     ->join('college_01', 'bc_01.id', '=', 'college_01.id')
    //     ->join('doctor_01', 'bc_01.id', '=', 'doctor_01.id')
    //     ->join('electricity_01', 'bc_01.id', '=', 'electricity_01.id')
    //     ->join('petrolpump_01', 'bc_01.id', '=', 'petrolpump_01.id')
    //     ->join('restaurant_01', 'bc_01.id', '=', 'restaurant_01.id')
    //     ->join('school_01', 'bc_01.id', '=', 'school_01.id')
    //     ->join('temple_01', 'bc_01.id', '=', 'temple_01.id')
    //     ->join('wership_01', 'bc_01.id', '=', 'wership_01.id')
    //     ->select(
    //         'bc_01.id as bc_01_id',
    //         'bc_02.id as bc_02_id',
    //         'bc_03.id as bc_03_id',
    //         'bigshop_01.id as bigshop_01_id',
    //         'bigshop_02.id as bigshop_02_id',
    //         'cinema_03.id as cinema_03_id',
    //         'college_01.id as college_01_id',
    //         'doctor_01.id as doctor_01_id',
    //         'electricity_01.id as electricity_01_id',
    //         'petrolpump_01.id as petrolpump_01_id',
    //         'restaurant_01.id as restaurant_01_id',
    //         'school_01.id as school_01_id',
    //         'temple_01.id as temple_01_id',
    //         'wership_01.id as wership_01_id'
    //         // Add other columns you need from each table
    //     )
    //     ->offset($offset)  // Apply the offset for the page
    //     ->limit($perPage)  // Limit the results to 1000 per page
    //     ->get();

    // // Get the total count of records for pagination info
    // $total = DB::table('bc_01')
    //     ->join('bc_02', 'bc_01.id', '=', 'bc_02.id')
    //     ->join('bc_03', 'bc_01.id', '=', 'bc_03.id')
    //     ->join('bigshop_01', 'bc_01.id', '=', 'bigshop_01.id')
    //     ->join('bigshop_02', 'bc_01.id', '=', 'bigshop_02.id')
    //     ->join('cinema_03', 'bc_01.id', '=', 'cinema_03.id')
    //     ->join('college_01', 'bc_01.id', '=', 'college_01.id')
    //     ->join('doctor_01', 'bc_01.id', '=', 'doctor_01.id')
    //     ->join('electricity_01', 'bc_01.id', '=', 'electricity_01.id')
    //     ->join('petrolpump_01', 'bc_01.id', '=', 'petrolpump_01.id')
    //     ->join('restaurant_01', 'bc_01.id', '=', 'restaurant_01.id')
    //     ->join('school_01', 'bc_01.id', '=', 'school_01.id')
    //     ->join('temple_01', 'bc_01.id', '=', 'temple_01.id')
    //     ->join('wership_01', 'bc_01.id', '=', 'wership_01.id')
    //     ->count();  // Get total row count for pagination

    // // Return paginated data as JSON response
    // return response()->json([
    //     'data' => $data,
    //     'current_page' => $page,
    //     'per_page' => $perPage,
    //     'total' => $total,
    //     'last_page' => ceil($total / $perPage),
    //     'first_page_url' => url("/api/fetch-data?page=1"),
    //     'last_page_url' => url("/api/fetch-data?page=" . ceil($total / $perPage)),
    //     'next_page_url' => $page < ceil($total / $perPage) ? url("/api/fetch-data?page=" . ($page + 1)) : null,
    //     'prev_page_url' => $page > 1 ? url("/api/fetch-data?page=" . ($page - 1)) : null,
    // ]);
    // }



    // public function search(Request $request)
    // {
    //     // return "working";
    //     // Set your search term and pagination parameters
    //     $searchTerm = $request->get('searchTerm', '');
    //     $pageSize = 10;
    //     $page = $request->get('page', 1);
    //     $offset = ($page - 1) * $pageSize;



    //     // SELECT name, phonenumber,NULL as villagename FROM `regtech-api`.bc_01
    //     // Perform the query with UNION ALL and pagination
    //     $filteredData = DB::table(DB::raw("(
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_01
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_02
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_03
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_04
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_05
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_01
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_02
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_03
    //         UNION ALL
    //         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_04
    //     ) AS combined"))
    //         ->where('name', 'LIKE', '%' . $searchTerm . '%')
    //         // ->whereNull('villagename')
    //         ->skip($offset)
    //         ->take($pageSize)
    //         ->get();

    //     return response()->json($filteredData);
    // }

    //     public function search(Request $request)
// {
//     // Set your search term and pagination parameters
//     $searchTerm = $request->get('searchTerm', '');
//     $pageSize = 10;
//     $page = $request->get('page', 1);
//     $offset = ($page - 1) * $pageSize;

    //     // Combined query for the data
//     $combinedQuery = DB::table(DB::raw("(
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_04
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_05
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_04
//     ) AS combined"))
//     ->where('name', 'LIKE', '%' . $searchTerm . '%');

    //     // Get the total count of matching records
//     $totalCount = $combinedQuery->count();

    //     // Get the paginated results
//     $filteredData = $combinedQuery
//         ->skip($offset)
//         ->take($pageSize)
//         ->get();

    //     // Return the data with the total count
//     return response()->json([
//         'totalCount' => $totalCount,
//         'data' => $filteredData
//     ]);
// }


    // public function search(Request $request)
// {
//     // Set your search term and pagination parameters
//     $searchTerm = $request->get('searchTerm', '');
//     $searchField = $request->get('searchField', '');
//     $pageSize = 2000;
//     $page = $request->get('page', 1);
//     $offset = ($page - 1) * $pageSize;

    //     // Combined query for the data
//     $combinedQuery = DB::table(DB::raw("(
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_04
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_05
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_04
//     ) AS combined"))
//     // ->where('name', 'LIKE', '%' . $searchTerm . '%');
//     ->where($searchField, 'LIKE', '%' . $searchTerm . '%');

    //     // Get the total count of matching records
//     $totalCount = $combinedQuery->count();

    //     // Get the paginated results
//     $filteredData = $combinedQuery
//         ->skip($offset)
//         ->take($pageSize)
//         ->get();

    //     // Calculate pagination details
//     $totalPages = ceil($totalCount / $pageSize);
//     $prevPage = $page > 1 ? $page - 1 : null;
//     $nextPage = $page < $totalPages ? $page + 1 : null;

    //     // Return the data with pagination details
//     return response()->json([
//         'totalCount' => $totalCount,
//         'currentPage' => $page,
//         'totalPages' => $totalPages,
//         'prevPage' => $prevPage,
//         'nextPage' => $nextPage,
//         'data' => $filteredData
//     ]);
// }


    // public function search(Request $request)
// {
//     set_time_limit(1000);
//     // return $request->all();
//     // Set your search term and pagination parameters
//     $searchTerm = $request->get('searchTerm', '');
//     $searchField = $request->get('searchField', '');
//     // $pageSize = 10;
//     $pageSize = 500;
//     $page = $request->get('page', 1);
//     $offset = ($page - 1) * $pageSize;

    //     // Combined query for the data
//     $combinedQuery = DB::table(DB::raw("(
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_04
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bigshop_05
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_02
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.bc_04
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.college_01
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.college_03
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.college_04
//         UNION ALL
//         SELECT name, phonenumber, Pincode, StateName, DistrictName FROM `regtech-api`.college_05
//     ) AS combined"));

    //     // Apply the search condition dynamically
//     if (!empty($searchTerm) && !empty($searchField)) {
//         // $combinedQuery = $combinedQuery->where($searchField, 'LIKE', '%' . $searchTerm . '%');
//         $combinedQuery = $combinedQuery->where($searchField, 'LIKE', '%' . $searchTerm . '%');
//     }

    //     // Get the total count of matching records
//     $totalCount = $combinedQuery->count();

    //     // Get the paginated results
//     $filteredData = $combinedQuery
//         ->skip($offset)
//         ->take($pageSize)
//         ->get();

    //     // Calculate pagination details
//     $totalPages = ceil($totalCount / $pageSize);
//     $prevPage = $page > 1 ? $page - 1 : null;
//     $nextPage = $page < $totalPages ? $page + 1 : null;

    //     // Return the data with pagination details
//     return response()->json([
//         'totalCount' => $totalCount,
//         'currentPage' => $page,
//         'totalPages' => $totalPages,
//         'prevPage' => $prevPage,
//         'nextPage' => $nextPage,
//         'data' => $filteredData
//     ]);
// }


    // app/Http/Controllers/DataController.php


    // public function search(Request $request)
    // {
    //     // return $request->all();
    //     $data = [];

    //     $tables = [
    //         'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01', 'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05', 'college_01', 'college_03', 'college_04', 'college_05',
    //     ];

    //     foreach ($tables as $table) {
    //         $query = DB::table($table);

    //         // Apply filtering
    //         if ($request->has('filter') && $request->has('option')) {
    //             $query->where($request->input('option'), 'like', '%' . $request->input('filter') . '%');
    //         }

    //         // Paginate results
    //         $results = $query->paginate(100);

    //         // Store results in data array
    //         $data[$table] = $results->toArray();
    //     }

    //     return response()->json($data);
    // }


    //     public function search(Request $request)
// {
//     set_time_limit(1500);
//     $recordPerTable = $request->input('recordPerTable');
//     $data = [];

    // $tables = [
    //     'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01', 'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05', 'college_01', 'college_03', 'college_04', 'college_05', 'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04', 'electricity_01', 'electricity_02', 'electricity_03', 'electricity_04', 'petrolpump_01', 'petrolpump_02', 'petrolpump_03', 'petrolpump_04', 'petrolpump_05', 'restaurant_01', 'restaurant_02', 'restaurant_03', 'restaurant_04', 'restaurant_05', 'school_01', 'school_02', 'school_03', 'school_04', 'school_05', 'temple_01', 'temple_02', 'temple_03', 'temple_04', 'wership_01', 'wership_02', 'wership_03', 'wership_04', 'wership_05', 'cinema_03', 'advbdata_ap_and_ts_62', 'advbdata_kn_15', 'advbdata_gj_75', 'advbdata_mh_249', 'advbdata_mumbai_66'
    // ];

    //     $tables = [
//         'bc_01', 'bc_02', 'college_01', 'petrolpump_04'
//     ];

    //     foreach ($tables as $table) {
//         $query = DB::table($table);

    //         if ($request->has('filter') && $request->has('option')) {
//             $query->where($request->input('option'), 'like', '%' . $request->input('filter') . '%');
//         }

    //         // Paginate results
//         // $results = $query->paginate(100);
//         $results = $query->paginate($recordPerTable);

    //         // Store results in data array
//         $data[$table] = $results->toArray();
//     }

    //     return response()->json($data);
// }

    public function search(Request $request)
    {
        set_time_limit(600);
        $recordPerTable = $request->input('recordPerTable');
        $tableRange = $request->input('tableRange');
        $category = $request->input('category');
        $tableName = $request->input('tableName');
        $data = [];

        if ($category == "Bombay") {
            $tables = [
                'bc_01',
                'bc_02',
                'bc_03',
                'bc_04',
            ];
        }

        if ($category == "Store & Mall") {
            $tables = [
                'bigshop_01',
                'bigshop_02',
                'bigshop_03',
                'bigshop_04',
                'bigshop_05',
            ];
        }

        if ($category == "College") {
            $tables = [
                'college_01',
                'college_03',
                'college_04',
                'college_05',
            ];
        }

        if ($category == "Doctor") {
            $tables = [
                'doctor_01',
                'doctor_02',
                'doctor_03',
                'doctor_04',
            ];
        }

        if ($category == "Electricity") {
            $tables = [
                'electricity_01',
                'electricity_02',
                'electricity_03',
                'electricity_04',
            ];
        }

        if ($category == "Petrol Pump") {
            $tables = [
                'petrolpump_01',
                'petrolpump_02',
                'petrolpump_03',
                'petrolpump_04',
                'petrolpump_05',
            ];
        }

        if ($category == "Restaurant") {
            $tables = [
                'restaurant_01',
                'restaurant_02',
                'restaurant_03',
                'restaurant_04',
                'restaurant_05',
            ];
        }


        if ($category == "School") {
            $tables = [
                'school_01',
                'school_02',
                'school_03',
                'school_04',
                'school_05',
            ];
        }

        if ($category == "Temple") {
            $tables = [
                'temple_01',
                'temple_02',
                'temple_03',
                'temple_04',
            ];
        }

        if ($category == "Wership") {
            $tables = [
                'wership_01',
                'wership_02',
                'wership_03',
                'wership_04',
                'wership_05',
            ];
        }

        if ($category == "Cinema") {
            $tables = [
                'cinema_03',
            ];
        }

        if ($category == "Cinema") {
            $tables = [
                'cinema_03',
            ];
        }

        if ($category == "Laptop") {
            if ($tableRange == "1-50") {
                $tables = [
                    'advbdata_ap_and_ts_01',
                    'advbdata_ap_and_ts_02',
                    'advbdata_ap_and_ts_03',
                    'advbdata_ap_and_ts_04',
                    'advbdata_ap_and_ts_05',
                    'advbdata_ap_and_ts_06',
                    'advbdata_ap_and_ts_07',
                    'advbdata_ap_and_ts_08',
                    'advbdata_ap_and_ts_09',
                    'advbdata_ap_and_ts_10',
                    'advbdata_ap_and_ts_11',
                    'advbdata_ap_and_ts_12',
                    'advbdata_ap_and_ts_13',
                    'advbdata_ap_and_ts_14',
                    'advbdata_ap_and_ts_15',
                    'advbdata_ap_and_ts_16',
                    'advbdata_ap_and_ts_17',
                    'advbdata_ap_and_ts_18',
                    'advbdata_ap_and_ts_19',
                    'advbdata_ap_and_ts_20',
                    'advbdata_ap_and_ts_21',
                    'advbdata_ap_and_ts_22',
                    'advbdata_ap_and_ts_23',
                    'advbdata_ap_and_ts_24',
                    'advbdata_ap_and_ts_25',
                    'advbdata_ap_and_ts_27',
                    'advbdata_ap_and_ts_28',
                    'advbdata_ap_and_ts_29',
                    'advbdata_ap_and_ts_30',
                    'advbdata_ap_and_ts_31',
                    'advbdata_ap_and_ts_32',
                    'advbdata_ap_and_ts_33',
                    'advbdata_ap_and_ts_34',
                    'advbdata_ap_and_ts_35',
                    'advbdata_ap_and_ts_36',
                    'advbdata_ap_and_ts_37',
                    'advbdata_ap_and_ts_38',
                    'advbdata_ap_and_ts_39',
                    'advbdata_ap_and_ts_40',
                    'advbdata_ap_and_ts_41',
                    'advbdata_ap_and_ts_42',
                    'advbdata_ap_and_ts_43',
                    'advbdata_ap_and_ts_44',
                    'advbdata_ap_and_ts_45',
                    'advbdata_ap_and_ts_46',
                    'advbdata_ap_and_ts_47',
                    'advbdata_ap_and_ts_48',
                    'advbdata_ap_and_ts_49',

                ];
            }

            if ($tableRange == "51-100") {
                $tables = [
                    'advbdata_ap_and_ts_52',
                    'advbdata_ap_and_ts_53',
                    'advbdata_ap_and_ts_54',
                    'advbdata_ap_and_ts_55',
                    'advbdata_ap_and_ts_56',
                    'advbdata_ap_and_ts_57',
                    'advbdata_ap_and_ts_58',
                    'advbdata_ap_and_ts_59',
                    'advbdata_ap_and_ts_60',
                    'advbdata_ap_and_ts_61',
                    'advbdata_ap_and_ts_62',
                    'advbdata_ap_and_ts_63',
                    'advbdata_ap_and_ts_64',
                    'advbdata_ap_and_ts_65',
                    'advbdata_ap_and_ts_66',
                    'advbdata_ap_and_ts_67',
                    'advbdata_ap_and_ts_68',
                    'advbdata_ap_and_ts_69',
                    'advbdata_ap_and_ts_70',
                    'advbdata_ap_and_ts_71',
                    'advbdata_ap_and_ts_72',
                    'advbdata_ap_and_ts_73',
                    'advbdata_ap_and_ts_74',
                    'advbdata_ap_and_ts_75',
                    'advbdata_ap_and_ts_76',
                    'advbdata_ap_and_ts_77',
                    'advbdata_ap_and_ts_78',
                    'advbdata_ap_and_ts_79',
                    'advbdata_ap_and_ts_50',
                    'advbdata_ap_and_ts_51',
                    'advbdata_KN_01',
                    'advbdata_KN_02',
                    'advbdata_KN_03',
                    'advbdata_KN_04',
                    'advbdata_KN_05',
                    'advbdata_KN_06',
                    'advbdata_KN_07',
                    'advbdata_KN_08',
                    'advbdata_KN_09',
                    'advbdata_KN_10',
                    'advbdata_KN_11',
                    'advbdata_KN_12',
                    'advbdata_KN_13',
                    'advbdata_KN_14',
                    'advbdata_KN_15',
                    'advbdata_KN_16',
                    'advbdata_KN_17',
                    'advbdata_KN_18',

                ];

            }

            if ($tableRange == "101-150") {
                $tables = [
                    'advbdata_KN_19',
                    'advbdata_KN_20',
                    'advbdata_KN_21',
                    'advbdata_KN_22',
                    'advbdata_KN_23',
                    'advbdata_KN_24',
                    'advbdata_KN_25',
                    'advbdata_KN_26',
                    'advbdata_KN_27',
                    'advbdata_KN_28',
                    'advbdata_KN_29',
                    'advbdata_KN_30',
                    'advbdata_KN_31',
                    'advbdata_KN_32',
                    'advbdata_KN_33',
                    'advbdata_KN_34',
                    'advbdata_KN_35',
                    'advbdata_KN_36',
                    'advbdata_KN_37',
                    'advbdata_KN_38',
                    'advbdata_KN_39',
                    'advbdata_KN_40',
                    'advbdata_KN_41',
                    'advbdata_KN_42',
                    'advbdata_KN_43',
                    'advbdata_KN_44',
                    'advbdata_KN_45',
                    'advbdata_KN_46',
                    'advbdata_KN_47',
                    'advbdata_KN_48',
                    'advbdata_KN_49',
                    'advbdata_KN_50',
                    'advbdata_KN_51',
                    'advbdata_KN_52',
                    'advbdata_KN_53',
                    'advbdata_KN_54',
                    'advbdata_KN_55',
                    'advbdata_KN_56',
                    'advbdata_KN_57',
                    'advbdata_KN_58',
                    'advbdata_KN_59',
                    'advbdata_KN_60',
                    'advbdata_KN_61',
                    'advbdata_KN_62',
                    'advbdata_KN_63',
                    'advbdata_KN_64',
                    'advbdata_KN_65',
                    'advbdata_KN_66',

                ];
            }

            if ($tableRange == "151-200") {
                $tables = [
                    'advbdata_GJ_01',
                    'advbdata_GJ_02',
                    'advbdata_GJ_03',
                    'advbdata_GJ_04',
                    'advbdata_GJ_05',
                    'advbdata_GJ_06',
                    'advbdata_GJ_07',
                    'advbdata_GJ_08',
                    'advbdata_GJ_09',
                    'advbdata_GJ_10',
                    'advbdata_GJ_11',
                    'advbdata_GJ_12',
                    'advbdata_GJ_13',
                    'advbdata_GJ_14',
                    'advbdata_GJ_15',
                    'advbdata_GJ_16',
                    'advbdata_GJ_17',
                    'advbdata_GJ_18',
                    'advbdata_GJ_19',
                    'advbdata_GJ_20',
                    'advbdata_GJ_21',
                    'advbdata_GJ_22',
                    'advbdata_GJ_23',
                    'advbdata_GJ_24',
                    'advbdata_GJ_25',
                    'advbdata_GJ_26',
                    'advbdata_GJ_27',
                    'advbdata_GJ_28',
                    'advbdata_GJ_29',
                    'advbdata_GJ_30',
                    'advbdata_GJ_31',
                    'advbdata_GJ_32',
                    'advbdata_GJ_33',
                    'advbdata_GJ_34',
                    'advbdata_GJ_35',
                    'advbdata_GJ_36',
                    'advbdata_GJ_37',
                    'advbdata_GJ_38',
                    'advbdata_GJ_39',
                    'advbdata_GJ_40',
                    'advbdata_GJ_41',
                    'advbdata_GJ_42',
                    'advbdata_GJ_43',
                    'advbdata_GJ_44',
                    'advbdata_GJ_45',
                    'advbdata_GJ_46',
                    'advbdata_GJ_47',
                    'advbdata_GJ_48',

                ];
            }


            if ($tableRange == "201-250") {
                $tables = [
                    'advbdata_GJ_49',
                    'advbdata_GJ_50',
                    'advbdata_GJ_51',
                    'advbdata_GJ_52',
                    'advbdata_GJ_53',
                    'advbdata_GJ_54',
                    'advbdata_GJ_55',
                    'advbdata_GJ_56',
                    'advbdata_GJ_57',
                    'advbdata_GJ_58',
                    'advbdata_GJ_59',
                    'advbdata_GJ_60',
                    'advbdata_GJ_61',
                    'advbdata_GJ_62',
                    'advbdata_GJ_63',
                    'advbdata_GJ_64',
                    'advbdata_GJ_65',
                    'advbdata_GJ_66',
                    'advbdata_GJ_67',
                    'advbdata_GJ_68',
                    'advbdata_GJ_69',
                    'advbdata_GJ_70',
                    'advbdata_GJ_71',
                    'advbdata_GJ_72',
                    'advbdata_GJ_73',
                    // 'advbdata_GJ_74',
                    'advbdata_GJ_75',
                    'advbdata_GJ_76',
                    'advbdata_GJ_77',
                    'advbdata_GJ_78',
                    'advbdata_GJ_79',
                    'advbdata_MH_01',
                    'advbdata_MH_02',
                    'advbdata_MH_03',
                    'advbdata_MH_04',
                    'advbdata_MH_05',
                    'advbdata_MH_06',
                    'advbdata_MH_07',
                    'advbdata_MH_08',
                    'advbdata_MH_09',
                    'advbdata_MH_10',
                    'advbdata_MH_11',
                    'advbdata_MH_12',
                    'advbdata_MH_13',
                    'advbdata_MH_14',
                    'advbdata_MH_15',
                    'advbdata_MH_16',
                    'advbdata_MH_18',

                ];
            }


            if ($tableRange == "251-300") {
                $tables = [
                    'advbdata_MH_19',
                    'advbdata_MH_20',
                    'advbdata_MH_21',
                    'advbdata_MH_22',
                    'advbdata_MH_23',
                    'advbdata_MH_24',
                    'advbdata_MH_25',
                    'advbdata_MH_26',
                    'advbdata_MH_27',
                    'advbdata_MH_28',
                    'advbdata_MH_29',
                    'advbdata_MH_30',
                    'advbdata_MH_31',
                    'advbdata_MH_32',
                    'advbdata_MH_33',
                    'advbdata_MH_34',
                    'advbdata_MH_35',
                    'advbdata_MH_36',
                    'advbdata_MH_37',
                    'advbdata_MH_38',
                    'advbdata_MH_39',
                    'advbdata_MH_40',
                    'advbdata_MH_41',
                    'advbdata_MH_42',
                    'advbdata_MH_43',
                    'advbdata_MH_44',
                    'advbdata_MH_45',
                    'advbdata_MH_46',
                    'advbdata_MH_47',
                    'advbdata_MH_48',
                    'advbdata_MH_49',
                    'advbdata_MH_50',
                    'advbdata_MH_51',
                    'advbdata_MH_52',
                    'advbdata_MH_53',
                    'advbdata_MH_54',
                    'advbdata_MH_55',
                    'advbdata_MH_56',
                    'advbdata_MH_57',
                    'advbdata_MH_58',
                    'advbdata_MH_59',
                    'advbdata_MH_60',
                    'advbdata_MH_61',
                    'advbdata_MH_62',
                    'advbdata_MH_63',
                    'advbdata_MH_64',
                    'advbdata_MH_65',
                    'advbdata_MH_66',

                ];
            }


            if ($tableRange == "301-350") {
                $tables = [
                    'advbdata_MH_67',
                    'advbdata_MH_68',
                    'advbdata_MH_69',
                    'advbdata_MH_70',
                    'advbdata_MH_71',
                    'advbdata_MH_72',
                    'advbdata_MH_73',
                    'advbdata_MH_74',
                    'advbdata_MH_75',
                    'advbdata_MH_76',
                    'advbdata_MH_77',
                    'advbdata_MH_78',
                    'advbdata_MH_79',
                    'advbdata_MH_80',
                    'advbdata_MH_81',
                    'advbdata_MH_82',
                    'advbdata_MH_83',
                    'advbdata_MH_84',
                    'advbdata_MH_85',
                    'advbdata_MH_86',
                    'advbdata_MH_87',
                    'advbdata_MH_88',
                    'advbdata_MH_89',
                    'advbdata_MH_90',
                    'advbdata_MH_91',
                    'advbdata_MH_92',
                    'advbdata_MH_93',
                    'advbdata_MH_94',
                    'advbdata_MH_95',
                    'advbdata_MH_96',
                    'advbdata_MH_97',
                    'advbdata_MH_98',
                    'advbdata_MH_99',
                    'advbdata_MH_100',
                    'advbdata_MH_101',
                    'advbdata_MH_102',
                    'advbdata_MH_103',
                    'advbdata_MH_104',
                    'advbdata_MH_105',
                    'advbdata_MH_106',
                    'advbdata_MH_107',
                    'advbdata_MH_108',
                    'advbdata_MH_109',
                    'advbdata_MH_110',
                    'advbdata_MH_111',
                    'advbdata_MH_112',
                    'advbdata_MH_113',
                    'advbdata_MH_114',

                ];
            }


            if ($tableRange == "351-400") {
                $tables = [
                    'advbdata_MH_115',
                    'advbdata_MH_116',
                    'advbdata_MH_117',
                    'advbdata_MH_118',
                    'advbdata_MH_119',
                    'advbdata_MH_120',
                    'advbdata_MH_121',
                    'advbdata_MH_122',
                    'advbdata_MH_123',
                    'advbdata_MH_124',
                    'advbdata_MH_125',
                    'advbdata_MH_126',
                    'advbdata_MH_127',
                    'advbdata_MH_128',
                    'advbdata_MH_129',
                    'advbdata_MH_130',
                    'advbdata_MH_131',
                    'advbdata_MH_132',
                    'advbdata_MH_133',
                    'advbdata_MH_134',
                    'advbdata_MH_135',
                    'advbdata_MH_136',
                    'advbdata_MH_137',
                    'advbdata_MH_138',
                    'advbdata_MH_139',
                    'advbdata_MH_140',
                    'advbdata_MH_141',
                    'advbdata_MH_142',
                    'advbdata_MH_143',
                    'advbdata_MH_144',
                    'advbdata_MH_145',
                    'advbdata_MH_146',
                    'advbdata_MH_147',
                    'advbdata_MH_148',
                    'advbdata_MH_149',
                    'advbdata_MH_150',
                    'advbdata_MH_151',
                    'advbdata_MH_152',
                    'advbdata_MH_153',
                    'advbdata_MH_154',
                    'advbdata_MH_155',
                    'advbdata_MH_156',
                    'advbdata_MH_157',
                    'advbdata_MH_158',
                    'advbdata_MH_159',
                    'advbdata_MH_160',
                    'advbdata_MH_161',
                    'advbdata_MH_162',

                ];
            }

            if ($tableRange == "401-450") {
                $tables = [
                    'advbdata_MH_163',
                    'advbdata_MH_164',
                    'advbdata_MH_165',
                    'advbdata_MH_166',
                    'advbdata_MH_167',
                    'advbdata_MH_168',
                    'advbdata_MH_169',
                    'advbdata_MH_170',
                    'advbdata_MH_171',
                    'advbdata_MH_172',
                    'advbdata_MH_173',
                    'advbdata_MH_174',
                    'advbdata_MH_175',
                    'advbdata_MH_176',
                    'advbdata_MH_177',
                    'advbdata_MH_178',
                    'advbdata_MH_179',
                    'advbdata_MH_180',
                    'advbdata_MH_181',
                    'advbdata_MH_182',
                    'advbdata_MH_183',
                    'advbdata_MH_184',
                    'advbdata_MH_185',
                    'advbdata_MH_186',
                    'advbdata_MH_187',
                    'advbdata_MH_188',
                    'advbdata_MH_189',
                    'advbdata_MH_190',
                    'advbdata_MH_191',
                    'advbdata_MH_192',
                    'advbdata_MH_193',
                    'advbdata_MH_194',
                    'advbdata_MH_195',
                    'advbdata_MH_196',
                    'advbdata_MH_197',
                    'advbdata_MH_198',
                    'advbdata_MH_199',
                    'advbdata_MH_200',
                    'advbdata_MH_201',
                    'advbdata_MH_202',
                    'advbdata_MH_203',
                    'advbdata_MH_204',
                    'advbdata_MH_205',
                    'advbdata_MH_206',
                    'advbdata_MH_207',
                    'advbdata_MH_208',
                    'advbdata_MH_209',
                    'advbdata_MH_210',
                    'advbdata_MH_211',

                ];
            }

            if ($tableRange == "451-500") {
                $tables = [

                    'advbdata_MH_212',
                    'advbdata_MH_213',
                    'advbdata_MH_214',
                    'advbdata_MH_215',
                    'advbdata_MH_216',
                    'advbdata_MH_217',
                    'advbdata_MH_218',
                    'advbdata_MH_219',
                    'advbdata_MH_220',
                    'advbdata_MH_221',
                    'advbdata_MH_222',
                    'advbdata_MH_223',
                    'advbdata_MH_224',
                    'advbdata_MH_225',
                    'advbdata_MH_226',
                    'advbdata_MH_227',
                    'advbdata_MH_228',
                    'advbdata_MH_229',
                    'advbdata_MH_230',
                    'advbdata_MH_231',
                    'advbdata_MH_232',
                    'advbdata_MH_233',
                    'advbdata_MH_234',
                    'advbdata_MH_235',
                    'advbdata_MH_236',
                    'advbdata_MH_237',
                    'advbdata_MH_238',
                    'advbdata_MH_239',
                    'advbdata_MH_240',
                    'advbdata_MH_241',
                    'advbdata_MH_242',
                    'advbdata_MH_243',
                    'advbdata_MH_244',
                    'advbdata_MH_245',
                    'advbdata_MH_246',
                    'advbdata_MH_247',
                    'advbdata_MH_248',
                    'advbdata_MH_249',
                    'advbdata_MH_250',
                    'advbdata_MH_251',
                    'advbdata_MH_252',
                    'advbdata_MH_253',
                    'advbdata_MH_254',
                    'advbdata_MH_255',
                    'advbdata_MH_256',
                    'advbdata_MH_257',
                    'advbdata_MH_258',
                    'advbdata_MUMBAI_01',
                    'advbdata_MUMBAI_02',

                ];
            }



            if ($tableRange == "501-550") {
                $tables = [

                    'advbdata_MUMBAI_03',
                    'advbdata_MUMBAI_04',
                    'advbdata_MUMBAI_05',
                    'advbdata_MUMBAI_06',
                    'advbdata_MUMBAI_07',
                    'advbdata_MUMBAI_08',
                    'advbdata_MUMBAI_09',
                    'advbdata_MUMBAI_10',
                    'advbdata_MUMBAI_11',
                    'advbdata_MUMBAI_12',
                    'advbdata_MUMBAI_13',
                    'advbdata_MUMBAI_14',
                    'advbdata_MUMBAI_15',
                    'advbdata_MUMBAI_16',
                    'advbdata_MUMBAI_17',
                    'advbdata_MUMBAI_18',
                    'advbdata_MUMBAI_19',
                    'advbdata_MUMBAI_20',
                    'advbdata_MUMBAI_21',
                    'advbdata_MUMBAI_22',
                    'advbdata_MUMBAI_23',
                    'advbdata_MUMBAI_24',
                    'advbdata_MUMBAI_25',
                    'advbdata_MUMBAI_26',
                    'advbdata_MUMBAI_27',
                    'advbdata_MUMBAI_28',
                    'advbdata_MUMBAI_29',
                    'advbdata_MUMBAI_30',
                    'advbdata_MUMBAI_31',
                    'advbdata_MUMBAI_32',
                    'advbdata_MUMBAI_33',
                    'advbdata_MUMBAI_34',
                    'advbdata_MUMBAI_35',
                    'advbdata_MUMBAI_36',
                    'advbdata_MUMBAI_37',
                    'advbdata_MUMBAI_38',
                    'advbdata_MUMBAI_39',
                    'advbdata_MUMBAI_40',
                    'advbdata_MUMBAI_41',
                    'advbdata_MUMBAI_42',
                    'advbdata_MUMBAI_43',
                    'advbdata_MUMBAI_44',
                    'advbdata_MUMBAI_45',
                    'advbdata_MUMBAI_46',
                    'advbdata_MUMBAI_47',
                    'advbdata_MUMBAI_48',
                    'advbdata_MUMBAI_49',
                    'advbdata_MUMBAI_50',
                    'advbdata_MUMBAI_51',
                    'advbdata_MUMBAI_52',

                ];
            }


            if ($tableRange == "551-600") {
                $tables = [


                    'advbdata_MUMBAI_53',
                    'advbdata_MUMBAI_54',
                    'advbdata_MUMBAI_55',
                    'advbdata_MUMBAI_56',
                    'advbdata_MUMBAI_57',
                    'advbdata_MUMBAI_58',
                    'advbdata_MUMBAI_59',
                    'advbdata_MUMBAI_60',
                    'advbdata_MUMBAI_61',
                    'advbdata_MUMBAI_62',
                    'advbdata_MUMBAI_63',
                    'advbdata_MUMBAI_64',
                    'advbdata_MUMBAI_65',
                    'advbdata_MUMBAI_66',
                    'advbdata_MUMBAI_67',
                    'advbdata_MUMBAI_68',
                    'advbdata_MUMBAI_69',
                    'advbdata_MUMBAI_70',
                    'advbdata_MUMBAI_71',
                    'advbdata_MUMBAI_72',
                    'advbdata_MUMBAI_73',
                    'advbdata_MUMBAI_74',
                    'advbdata_MUMBAI_75',
                    'advbdata_MUMBAI_76',
                    'advbdata_MUMBAI_77',
                    'advbdata_MUMBAI_78',
                    'advbdata_MUMBAI_80',
                    'advbdata_MUMBAI_81',
                    'advbdata_MUMBAI_82',
                    'advbdata_MUMBAI_83',
                    'advbdata_MUMBAI_84',
                    'advbdata_MUMBAI_85',
                    'advbdata_MUMBAI_86',
                    'advbdata_MUMBAI_87',
                    'advbdata_MUMBAI_88',
                    'advbdata_MUMBAI_89',
                    'advbdata_MUMBAI_90',
                    'advbdata_MUMBAI_91',
                    'advbdata_MUMBAI_92',
                    'advbdata_MUMBAI_93',
                    'advbdata_MUMBAI_94',
                    'advbdata_MUMBAI_95',
                    'advbdata_MUMBAI_96',
                    'advbdata_MUMBAI_97',
                    'advbdata_MUMBAI_98',
                    'advbdata_MUMBAI_99',
                    'advbdata_MUMBAI_100',
                    'advbdata_MUMBAI_101',
                    'advbdata_MUMBAI_102'
                ];
            }
        }








        // return $request->all();
        // Retrieve the filter and option inputs
        // $filters = $request->optionInObj; // Example: { "Name": "John", "PhoneNumber": "12345" }
        $filters = $request->input('optionInObj', []);

        // foreach ($tables as $table) {

        //     $query = DB::connection('second_db')->table($table);
        //     // $query = DB::table($table);

        //     foreach ($filters as $column => $value) {


        //         $query->where($column, 'like', '%' . $value . '%');


        //     }


        //     // $results = $query->paginate($recordPerTable);
        //     $results = $query->get();


        //     // $data[$table] = $results->toArray();
        //     $data[$table] = $results;
        // }



        $query = DB::connection('second_db')->table($tableName);
        // $query = DB::table($table);

        foreach ($filters as $column => $value) {
                $query->where($column, 'like', '%' . $value . '%');
        }


        // $results = $query->paginate($recordPerTable);
        $results = $query->get();


        // $data[$table] = $results->toArray();
        // $data[$tableName] = $results;


        return response()->json($results);
    }

    // new 30-04-2025
//     public function search(Request $request)
// {
//     set_time_limit(600);

//     $recordPerTable = $request->input('recordPerTable', 100);
//     $page = $request->input('page', 1);
//     $offset = ($page - 1) * $recordPerTable;

//     $tableName = $request->input('tableName');
//     $category = $request->input('category');
//     $filters = $request->input('optionInObj', []);

//     $query = DB::connection('second_db')->table($tableName);

//     foreach ($filters as $column => $value) {
//         $query->where($column, 'like', '%' . $value . '%');
//     }

//     $hasStateFilter = isset($filters['StateName']) && !empty($filters['StateName']);

//     // ✅ Condition for paginated response
//     if ($hasStateFilter && $category === 'Laptop') {
//         $total = (clone $query)->count();
//         $results = $query->offset($offset)->limit($recordPerTable)->get();

//         return response()->json([
//             'data' => $results,
//             'total' => $total,
//             'page' => $page,
//             'per_page' => $recordPerTable,
//         ]);
//     }

//     // 🔁 Default (non-paginated) behavior
//     $results = $query->get();

//     return response()->json($results);
// }



    //     public function search(Request $request)
// {
//     set_time_limit(1500);
//     $recordPerTable = $request->input('recordPerTable');
//     $data = [];
//     $tables = [
//         'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01',
//         'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05',
//         'college_01', 'college_03', 'college_04', 'college_05',
//         'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04',
//         'electricity_01', 'electricity_02', 'electricity_03',
//         'electricity_04', 'petrolpump_01', 'petrolpump_02',
//         'petrolpump_03', 'petrolpump_04', 'petrolpump_05',
//         'restaurant_01', 'restaurant_02', 'restaurant_03',
//         'restaurant_04', 'restaurant_05', 'school_01',
//         'school_02', 'school_03', 'school_04', 'school_05',
//         'temple_01', 'temple_02', 'temple_03', 'temple_04',
//         'wership_01', 'wership_02', 'wership_03', 'wership_04',
//         'wership_05', 'cinema_03', 'advbdata_ap_and_ts_01',
//         'advbdata_KN_01', 'advbdata_MH_01', 'advbdata_MUMBAI_01'
//     ];

    //     $filters = $request->input('optionInObj', []);
//     $retryCount = 3;

    //     foreach ($tables as $table) {
//         $attempt = 0;
//         $success = false;

    //         while ($attempt < $retryCount && !$success) {
//             try {
//                 $query = DB::connection('second_db')->table($table);

    //                 foreach ($filters as $column => $value) {
//                     $query->where($column, 'like', '%' . $value . '%');
//                 }

    //                 $results = $query->paginate($recordPerTable);
//                 $data[$table] = $results->toArray();
//                 $success = true;
//             } catch (Exception $e) {
//                 Log::error("Query failed for table $table: " . $e->getMessage());
//                 $attempt++;
//                 if ($attempt >= $retryCount) {
//                     throw $e;
//                 }
//             }
//         }
//     }

    //     return response()->json($data);
// }

    // public function search(Request $request)
//     {
//         set_time_limit(1500);
//         // Validate the incoming search query
//         $validated = $request->validate([
//             'query' => 'required|string|min:3', // You can modify the validation rules as per your need
//         ]);

    //         // The list of tables to search in
//         $tables = [
//             'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01',
//             'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05',
//             'college_01', 'college_03', 'college_04', 'college_05',
//             'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04',
//             'electricity_01', 'electricity_02', 'electricity_03',
//             'electricity_04', 'petrolpump_01', 'petrolpump_02',
//             'petrolpump_03', 'petrolpump_04', 'petrolpump_05',
//             'restaurant_01', 'restaurant_02', 'restaurant_03',
//             'restaurant_04', 'restaurant_05', 'school_01',
//             'school_02', 'school_03', 'school_04', 'school_05',
//             'temple_01', 'temple_02', 'temple_03', 'temple_04',
//             'wership_01', 'wership_02', 'wership_03', 'wership_04',
//             'wership_05', 'cinema_03', 'advbdata_ap_and_ts_01',
//             'advbdata_KN_01', 'advbdata_MH_01', 'advbdata_MUMBAI_01'
//         ];

    //         // Retrieve the search query from the request
//         $searchQuery = $validated['query'];

    //         // Initialize an array to store search results
//         $results = [];

    //         // Iterate over each table and perform the search
//         foreach ($tables as $table) {
//             // Assuming the column you're searching on is 'column_name', replace it with the actual column
//             $data = DB::connection('second_db')->table($table)
//                 ->where('Name', 'LIKE', "%$searchQuery%")
//                 ->paginate(100); // Paginate the results to avoid memory overload

    //             // Only add results if they exist
//             if ($data->count() > 0) {
//                 // Convert the paginated results to an array (including pagination data)
//                 $results[$table] = [
//                     'data' => $data->items(), // Data of the current page
//                     'pagination' => [
//                         'current_page' => $data->currentPage(),
//                         'per_page' => $data->perPage(),
//                         'total' => $data->total(),
//                         'last_page' => $data->lastPage(),
//                     ]
//                 ];
//             }
//         }

    //         // Return the search results as JSON
//         return response()->json([
//             'query' => $searchQuery,
//             'results' => $results
//         ]);
//     }


    // public function search(Request $request) {
//     $name = $request->name;
//     $connection = 'second_db';

    //     // Get all table names from the second-db schema collectiondb
//     $tables = DB::connection($connection)
//         ->table('INFORMATION_SCHEMA.TABLES')
//         ->where('TABLE_SCHEMA', 'collectiondb')
//         ->pluck('TABLE_NAME'); // Get just the table names

    //     // If tables are found, dynamically build the UNION ALL query
//     if (!empty($tables)) {
//         $unionQuery = collect($tables)->map(function ($table) use ($name) {
//             // Dynamically build the SQL with only the name filter using query bindings
//             return "SELECT * FROM `{$table}` WHERE name LIKE ?";
//         })->implode(" UNION ALL "); // Combine all queries with UNION ALL

    //         // Execute the query on the second-db connection with query bindings
//         $results = DB::connection($connection)->select($unionQuery, ["%$name%"]);

    //         return response()->json($results);
//     } else {
//         // If no tables found, return empty response
//         return response()->json([]);
//     }
// }

    // public function search(Request $request)
// {
//     set_time_limit(1500);
//     $name = $request->input('name'); // Get the name from the request input
//     $databaseName = 'collectiondb'; // Get the current database name

    //     // If the name parameter is empty, return an error or handle as needed
//     if (empty($name)) {
//         return response()->json(['error' => 'Name parameter is required'], 400);
//     }

    //     // Get all table names from the schema
//     $tables = DB::connection('second_db')->table('INFORMATION_SCHEMA.TABLES')
//         ->where('TABLE_SCHEMA', $databaseName)
//         ->pluck('TABLE_NAME')
//         ->toArray();

    //     // If no tables found, return an empty response
//     if (empty($tables)) {
//         return response()->json(['error' => 'No tables found in the database'], 400);
//     }

    //     // Get common columns from all tables
//     $commonColumns = DB::connection('second_db')->table('INFORMATION_SCHEMA.COLUMNS')
//         ->whereIn('TABLE_NAME', $tables)
//         ->where('TABLE_SCHEMA', $databaseName)
//         ->groupBy('COLUMN_NAME')
//         ->havingRaw("COUNT(DISTINCT TABLE_NAME) = ?", [count($tables)])
//         ->pluck('COLUMN_NAME')
//         ->toArray();

    //     // Ensure we have common columns
//     if (empty($commonColumns)) {
//         return response()->json(['error' => 'No common columns found in tables'], 400);
//     }

    //     // Build the column list for SELECT queries
//     $columnList = implode(', ', array_map(fn($col) => "`$col`", $commonColumns));

    //     // Build the UNION ALL query dynamically for each table
//     $unionQuery = collect($tables)->map(function ($table) use ($columnList, $name) {
//         // Use parameterized queries to prevent SQL injection
//         return "SELECT $columnList FROM `$table` WHERE name LIKE ?";
//     })->implode(" UNION ALL ");

    //     // Bind the name parameter for each query
//     try {
//         $results = DB::connection('second_db')->select($unionQuery, array_fill(0, count($tables), "%$name%"));
//     } catch (\Exception $e) {
//         // Return an error if the query fails
//         return response()->json(['error' => 'Query execution failed', 'message' => $e->getMessage()], 500);
//     }

    //     // Return results as JSON
//     return response()->json($results);
// }

    // public function search(Request $request)
//     {
//         set_time_limit(1500);
//         // Get the search term from the request (e.g., StateName or any other parameter)
//         $perPage = $request->input('per_page', 10); // Number of records per page, default is 1000

    //         // Prepare the result array to store results from all tables
//         $results = [];

    //         $tables = [
//             'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01', 'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05', 'college_01', 'college_03', 'college_04', 'college_05', 'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04', 'electricity_01', 'electricity_02', 'electricity_03', 'electricity_04', 'petrolpump_01', 'petrolpump_02', 'petrolpump_03', 'petrolpump_04', 'petrolpump_05', 'restaurant_01', 'restaurant_02', 'restaurant_03', 'restaurant_04', 'restaurant_05', 'school_01', 'school_02', 'school_03', 'school_04', 'school_05', 'temple_01', 'temple_02', 'temple_03', 'temple_04', 'wership_01', 'wership_02', 'wership_03', 'wership_04', 'wership_05', 'cinema_03'
//         ];

    //         // Loop over each table (bc_01 to bc_10) and query data
//         for ($i = 1; $i <46 ; $i++) {
//             $tableName = $tables[$i]; // Generate table name dynamically

    //             // Fetch data for each table using pagination
//             $data = DB::table($tableName)
//                 ->select('id', 'Name', 'PhoneNumber', 'StateName', 'DistrictName')
//                 // ->where('Name', '')
//                 ->orderBy('id', 'asc') // Sorting by id, assumed to be indexed
//                 ->paginate($perPage);

    //             // Add data to the results array
//             $results[] = [
//                 'table' => $tableName,
//                 'data' => $data
//             ];
//         }

    //         // Return the response as a JSON array
//         return response()->json($results);
//     }



    // public function search(Request $request)
//     {
//         set_time_limit(1500);
//         $tables = [
//             'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01', 'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05',
//             'college_01', 'college_03', 'college_04', 'college_05', 'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04',
//             'electricity_01', 'electricity_02', 'electricity_03', 'electricity_04', 'petrolpump_01', 'petrolpump_02',
//             'petrolpump_03', 'petrolpump_04', 'petrolpump_05', 'restaurant_01', 'restaurant_02', 'restaurant_03',
//             'restaurant_04', 'restaurant_05', 'school_01', 'school_02', 'school_03', 'school_04', 'school_05',
//             'temple_01', 'temple_02', 'temple_03', 'temple_04', 'wership_01', 'wership_02', 'wership_03', 'wership_04',
//             'wership_05', 'cinema_03',
//         ];

    //         $name = $request->input('name');
//         $limit = 5; // Limit per table for performance
//         $results = [];

    //         foreach ($tables as $table) {
//             // Check if the table exists in the database
//             if (!Schema::hasTable($table)) {
//                 continue;
//             }

    //             // Query each table
//             $data = DB::table($table)
//                 ->select('Name', 'Address', 'PhoneNumber', 'Pincode', 'VillageName', 'TalukaName', 'BankName', 'DistrictName', 'StateName', 'cname', 'fname', 'dob', 'doa', 'ladd', 'padd', 'email', 'gender', 'uid', 'altno', 'operator', 'ctype', 'adr')
//                 ->where('Name', 'LIKE', "%$name%")
//                 ->limit($limit)
//                 ->get();

    //             // Append results
//             if (!$data->isEmpty()) {
//                 $results[$table] = $data;
//             }
//         }

    //         return response()->json($results);
//     }

    // public function search(Request $request)
//     {
//         set_time_limit(1500);

    //         $tables = [
//             'bc_01', 'bc_02', 'bc_03', 'bc_04', 'bigshop_01', 'bigshop_02', 'bigshop_03', 'bigshop_04', 'bigshop_05',
//             'college_01', 'college_03', 'college_04', 'college_05', 'doctor_01', 'doctor_02', 'doctor_03', 'doctor_04',
//             'electricity_01', 'electricity_02', 'electricity_03', 'electricity_04', 'petrolpump_01', 'petrolpump_02',
//             'petrolpump_03', 'petrolpump_04', 'petrolpump_05', 'restaurant_01', 'restaurant_02', 'restaurant_03',
//             'restaurant_04', 'restaurant_05', 'school_01', 'school_02', 'school_03', 'school_04', 'school_05',
//             'temple_01', 'temple_02', 'temple_03', 'temple_04', 'wership_01', 'wership_02', 'wership_03', 'wership_04',
//             'wership_05', 'cinema_03'
//         ];

    //         $name = $request->input('name');
//         $page = $request->input('page', 1);
//         $limit = $request->input('limit', 10); // Set pagination limit
//         $offset = ($page - 1) * $limit;

    //         $totalRecords = 0;
//         $results = [];

    //         foreach ($tables as $table) {
//             if (!Schema::hasTable($table)) continue;

    //             // Count total records for pagination
//             $count = DB::table($table)->where('Name', 'LIKE', "%$name%")->count();
//             $totalRecords += $count;

    //             // Fetch paginated results
//             $data = DB::table($table)
//                 ->select('Name', 'Address', 'PhoneNumber', 'Pincode', 'VillageName', 'TalukaName', 'BankName', 'DistrictName', 'StateName', 'cname', 'fname', 'dob', 'doa', 'ladd', 'padd', 'email', 'gender', 'uid', 'altno', 'operator', 'ctype', 'adr')
//                 ->where('Name', 'LIKE', "%$name%")
//                 ->offset($offset)
//                 ->limit($limit)
//                 ->get();

    //             if (!$data->isEmpty()) {
//                 $results[$table] = $data;
//             }
//         }

    //         return response()->json([
//             'total_records' => $totalRecords,
//             'current_page' => $page,
//             'per_page' => $limit,
//             'data' => $results
//         ]);
//     }







    public function uploadExcel(Request $request)
    {
        $data = $request->input('data');

        try {
            foreach ($data as $row) {
                DB::table('imported_data')->insert([
                    'Address' => isset($row['Address']) ? $row['Address'] : null,
                    'BankName' => isset($row['BankName']) ? $row['BankName'] : null,
                    'DistrictName' => isset($row['DistrictName']) ? $row['DistrictName'] : null,
                    'Name' => isset($row['Name']) ? $row['Name'] : null,
                    'PhoneNumber' => isset($row['PhoneNumber']) ? $row['PhoneNumber'] : null,
                    'Pincode' => isset($row['Pincode']) ? $row['Pincode'] : null,
                    'StateName' => isset($row['StateName']) ? $row['StateName'] : null,
                    'TalukaName' => isset($row['TalukaName']) ? $row['TalukaName'] : null,
                    'VillageName' => isset($row['VillageName']) ? $row['VillageName'] : null,
                    'adr' => isset($row['adr']) ? $row['adr'] : null,
                    'altno' => isset($row['altno']) ? $row['altno'] : null,
                    'cname' => isset($row['cname']) ? $row['cname'] : null,
                    'ctype' => isset($row['ctype']) ? $row['ctype'] : null,
                    'doa' => isset($row['doa']) ? $row['doa'] : null,
                    'dob' => isset($row['dob']) ? $row['dob'] : null,
                    'email' => isset($row['email']) ? $row['email'] : null,
                    'fname' => isset($row['fname']) ? $row['fname'] : null,
                    'gender' => isset($row['gender']) ? $row['gender'] : null,
                    'ladd' => isset($row['ladd']) ? $row['ladd'] : null,
                    'operator' => isset($row['operator']) ? $row['operator'] : null,
                    'padd' => isset($row['padd']) ? $row['padd'] : null,
                    // If uid is missing, store it as null as well
                    'uid' => isset($row['uid']) ? $row['uid'] : null,
                ]);
            }

            return response()->json(['message' => 'Data uploaded successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error uploading data', 'error' => $e->getMessage()], 500);
        }

    }



    // public function search(Request $request)
// {
//     set_time_limit(1500);
//     $recordPerTable = $request->input('recordPerTable');
//     $data = [];

    //     // You can leave this array as is or revert to the commented-out array if needed.
//     $tables = [
//         'bc_01', 'bc_02', 'college_01', 'petrolpump_04'
//     ];

    //     foreach ($tables as $table) {
//         $query = DB::table($table);

    //         if ($request->has('filter') && $request->has('option')) {
//             $query->where($request->input('option'), 'like', '%' . $request->input('filter') . '%');
//         }

    //         // Paginate results
//         $results = $query->paginate($recordPerTable);

    //         // Ensure you only get the correct number of records
//         if ($results->total() > $recordPerTable) {
//             $results = $results->take($recordPerTable);
//         }

    //         // Store results in data array
//         $data[$table] = $results->toArray();
//     }

    //     return response()->json($data);
// }

    public function getToken(Request $request)
    {
        // return $request->all();
        // Validate the incoming request to make sure necessary parameters are present
        // $validated = $request->validate([
        //     'code' => 'required|string',
        //     'code_verifier' => 'required|string',
        //     'redirect_uri' => 'required|url',
        // ]);
        $code = $request->input('code');            // or $request->code
        $code_verifier = $request->input('code_verifier'); // or $request->code_verifier
        $redirect_uri = $request->input('redirect_uri');

        // Define the request payload
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri, // Ensure this matches what was used in OAuth
            'code_verifier' => $code_verifier,
            'client_id' => 'OK82C6E731',  // Use your actual client_id
            'client_secret' => '952cfaa92f07c51544f6',  // Use your actual client_secret
        ];

        try {
            // Make the POST request using Guzzle (or Laravel's HTTP client)
            $response = Http::post('https://digilocker.meripehchaan.gov.in/public/oauth2/1/token', $data);

            // Check if the response is successful
            if ($response->successful()) {
                // Return the response to the frontend (you can modify this based on your needs)
                return response()->json($response->json(), 200);
            }

            // If response is not successful, return the error
            return response()->json([
                'error' => 'Failed to exchange code for token',
                'details' => $response->json(),
            ], $response->status());

        } catch (\Exception $e) {
            // Handle any exceptions (e.g., network errors)
            return response()->json([
                'error' => 'An error occurred while making the request',
                'message' => $e->getMessage(),
            ], 500);
        }
    }







    // public function updateTableTypes(Request $request)
    // {
    //     set_time_limit(1500);
    //     // Get the array of table names from the request
    //     $tables = $request->input('tables'); // Expecting an array of table names

    //     // Check if the input is not empty
    //     if (!empty($tables) && is_array($tables)) {
    //         // Loop through each table
    //         foreach ($tables as $table) {
    //             try {
    //                 // Ensure the column 'type' exists in the table to prevent SQL errors
    //                 if (DB::connection('second_db')->getSchemaBuilder()->hasColumn($table, 'type')) {
    //                     // Update the 'type' column to 'laptop' in each table using the second_db connection
    //                     DB::connection('second_db')->table($table)->update(['type' => 'laptop']);
    //                 } else {
    //                     // Log or handle the case where 'type' column does not exist
    //                     \Log::warning("Column 'type' does not exist in table: $table");
    //                 }
    //             } catch (\Exception $e) {
    //                 // Log or handle any errors during the update process
    //                 \Log::error("Error updating table $table: " . $e->getMessage());
    //             }
    //         }

    //         return response()->json(['message' => 'Tables updated successfully.']);
    //     } else {
    //         // Return a validation error if the tables array is empty or invalid
    //         return response()->json(['error' => 'Invalid input. Tables array is required.'], 400);
    //     }
    // }


    public function updateTableTypes(Request $request)
    {
        set_time_limit(44400);
        // Get the array of table names from the request
        $tables = $request->input('tables'); // Expecting an array of table names

        // Check if the input is not empty
        if (!empty($tables) && is_array($tables)) {
            // Loop through each table
            foreach ($tables as $table) {
                try {
                    // Ensure the column 'type' exists in the table to prevent SQL errors
                    if (DB::connection('second_db')->getSchemaBuilder()->hasColumn($table, 'type')) {
                        // Update the 'type' column to 'laptop' in each table using the second_db connection
                        DB::connection('second_db')->table($table)->update(['type' => 'laptop']);
                    } else {
                        // Log or handle the case where 'type' column does not exist
                        \Log::warning("Column 'type' does not exist in table: $table");
                    }
                } catch (\Exception $e) {
                    // Log or handle any errors during the update process
                    \Log::error("Error updating table $table: " . $e->getMessage());
                }
            }

            return response()->json(['message' => 'Tables updated successfully.']);
        } else {
            // Return a validation error if the tables array is empty or invalid
            return response()->json(['error' => 'Invalid input. Tables array is required.'], 400);
        }
    }

    // Test

    public function testMaheen(Request $request){
        // return "maheen";

        // validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
        ]);

        // returning

        return response()->json([
            'success' => true,
            'message' => 'Data recieved successfully.',
            'data' => $request->only(['name','email','dob']),
        ]);

    } 

}

