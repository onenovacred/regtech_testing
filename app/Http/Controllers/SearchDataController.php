<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class SearchDataController extends Controller
{
    //
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
        return view('search_data.index', compact('cheackdata'));
    }
   
    public function searchallData(Request $request)
    {
        
        $query = $request->input('query');
       
        $cheackdata1 = DB::table('bc_registry_chunk_1');
        $cheackdata2 = DB::table('bc_registry_chunk_2');
        $cheackdata3 = DB::table('bc_registry_chunk_3');
        $cheackdata4 = DB::table('bc_registry_chunk_4');

        $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
        $cheackdata = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
            ->mergeBindings($mergeTbl)->where('BCName', 'like', '%' . $query . '%')
                        ->orWhere('MobileNo', 'like', '%' . $query . '%')
                        ->orWhere('Pincode', 'like', '%' . $query . '%')
                        ->orWhere('State', 'like', '%' . $query . '%')
                        ->orWhere('District', 'like', '%' . $query . '%')
                  ->paginate(20);
        Paginator::useBootstrap();
        return response()->json([
            'results' => $cheackdata,
            'pagination' =>$cheackdata->links()->toHtml(),
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
      
       
        if($request->get('mobile_no') || $request->get('district') || $request->get('b_name') || $request->get('pincode') || $request->get('state')){
            $records =null;
            $cheackdata1 = DB::table('bc_registry_chunk_1');
            $cheackdata2 = DB::table('bc_registry_chunk_2');
            $cheackdata3 = DB::table('bc_registry_chunk_3');
            $cheackdata4 = DB::table('bc_registry_chunk_4');
            if($request->get('mobile_no')){
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('MobileNo',$request->mobile_no)
                    ->get();
            }
            if($request->get('district')){
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('District',$request->district)
                    ->get();
            }
            if($request->get('b_name')){
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('BCName',$request->b_name)
                    ->get();
            }
            if($request->get('pincode')){
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('Pincode',$request->pincode)
                    ->get();
            }
            if($request->get('state')){
                $mergeTbl = $cheackdata1->unionAll($cheackdata2)->unionAll($cheackdata3)->unionAll($cheackdata4);
                $records = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))
                    ->mergeBindings($mergeTbl)->where('State',$request->state)
                    ->get();
            }
           $file = fopen('export.csv', 'w');
           fputcsv($file, array_keys(get_object_vars($records->first())));
           foreach ($records as $record) {
               fputcsv($file, get_object_vars($record));
           }
           fclose($file);
           return response()->download('export.csv')->deleteFileAfterSend(true);
        }
      
        $request->session()->flash('message', 'please select export option.');
        return redirect()->route('search.data');
      
   
    }

}