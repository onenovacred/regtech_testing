<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EsignInfo;
use App\Models\EsignSignaturePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use File;
use Auth;
use App\Models\User;
use App\Models\HitCountMaster;
use App\Models\UserSchemeMaster;
use App\Models\Transaction;
use App\Models\ApiMaster;

class EsignApiController extends Controller
{

       // Save To hit_count_master table
       public function saveHitCount($user_id, $api_id, $remark, $statusCode)
       {
           $cnt200 = 0;
           $cnt400 = 0;
           $cnt101 = 0;
           $payableHits = 0;
           $scheme_price = 0;
           $total_amount = 0;
           $updateHitCount = UserSchemeMaster::where('user_id', $user_id)
               ->where('api_id', $api_id)
               ->orderBy('id', 'desc')
               ->first();
        
           $payment_slab = explode(',', $updateHitCount->payment_slab);
           $scheme_prices = explode(',', $updateHitCount->scheme_price);
           // $transactions = Transaction::where('user_id', $user_id)->where('api_id',$api_id)->where('hit_year_month', date('Y-m'))->get();
           $transactions = Transaction::where('user_id', $user_id)
               ->where('api_id', $api_id)
               ->where('hit_year_month', date('Y-m'))
               ->count();
           
           if ($transactions) {
            
               // for($i=0; $i<count($transactions);$i++){
               //     if($transactions[$i]['status_code'] == 102){
               //         $cnt400++;
               //     }else if($transactions[$i]['status_code'] == 200){
               //         $cnt200++;
               //     }else if($transactions[$i]['status_code'] == 101){
               //         $cnt101++;
               //     }
               // }
               // $payableHits = $cnt200 + $cnt400 + $cnt101;
               $payableHits = $transactions;
             
                for ($i = 0; $i < count($payment_slab); $i++) {
                   if ($i == count($payment_slab) - 1) {
                      
                      if ($payableHits <= $payment_slab[$i]) {
                         
                           $scheme_price = $scheme_prices[$i];
                           $total_amount = $payableHits * $scheme_prices[$i];
                       } else {
                           $scheme_price = $scheme_prices[$i];
                           $total_amount = $payableHits * $scheme_prices[$i];
                        
                       }
                       break;
                   } else {
                       if ($payableHits <= $payment_slab[$i]) {
                           $scheme_price = $scheme_prices[$i];
                           $total_amount = $payableHits * $scheme_prices[$i];
                           break;
                       }
                   }
               }
           } else {
               $scheme_price = $scheme_prices[0];
               $total_amount = $scheme_prices[0];
           }
   
           $updateHitCount->update([
               'total_transaction_amount_per_api' => $total_amount,
           ]);
   
           $addHitCount = new HitCountMaster();
           $addHitCount->user_id = $user_id;
           $addHitCount->api_id = $api_id;
           $addHitCount->scheme_price = $scheme_price;
           $addHitCount->hit_year_month = date('Y-m');
           $addHitCount->hit_count = 1;
           $addHitCount->save();
           $this->update_wallet_balance($user_id, $scheme_price);
           $this->update_transaction($user_id, $api_id, $scheme_price, $remark, $statusCode);
       }
       public function update_wallet_balance($user_id, $amount)
       {
           $userwallet = User::where('id', $user_id)->first();
           $userwallet->wallet_amount = $userwallet->wallet_amount - $amount;
           $userwallet->save();
       }
   
       public function transaction_id()
       {
           $str_result = '1234567890';
           $transaction_gen = substr(str_shuffle($str_result), 0, 12);
   
           $transaction = Transaction::where('transaction_id', $transaction_gen)->first();
           if ($transaction) {
               $transaction_gen = substr(str_shuffle($str_result), 0, 12);
           }
   
           return $transaction_gen;
       }
   
       public function update_transaction($user_id, $api_id, $amount, $remark, $statusCode)
       {
           $user = User::where('id', $user_id)->first();
           $transaction = new Transaction();
           $transaction->transaction_id = $this->transaction_id();
           $transaction->user_id = $user_id;
           $transaction->api_id = $api_id; //work
           $transaction->type_creditdebit = 'Debit';
           $transaction->hit_year_month = date('Y-m');
           $transaction->scheme_price = $amount; //work
           if ($statusCode == 200) {
               $transaction->status = 'Success';
           } else {
               $transaction->status = 'Failed';
           }
           $transaction->status_code = $statusCode;
           $transaction->amount = $amount;
           $transaction->remark = $remark;
          
           if ($statusCode != 500) {
               $transaction->updated_balance = $user->wallet_amount - $amount;
           } else {
               $transaction->updated_balance = $user->wallet_amount;
           }
           $transaction->save();
       }
   
    public function index(Request $request,$token)
    {
         $apiamster=null;
         $api_id=null;
         $user = User::where('access_token',$token)->first(); 
         if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'docboyzesign')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
        ->where('api_id', $api_id)
        ->orderBy('id', 'desc')
        ->first();
        if ($updateHitCount || $user->role_id == 0) {
            $access_token= $user->access_token;
            return view('e_sign_new_api.index',compact('access_token'));
        }
        else{
            return response()->json(['status_code'=>102,'message'=>'You are not registered to use this service']);
        }
      
    }
    
    public function GenerateEsignXml(Request $request)
    {
        // $request->validate(
        //     [
        //         'pdf_file' => 'required|mimes:pdf',
        //         'name_show_signature' => 'required',
        //         'location_show_signature' => 'required',
        //         'reasone_for_signature' => 'required',
        //         'choice_option' => 'required',
        //         'page_options' => 'required',
        //         'signature_stamp_page' => $request->input('page_options') === "single" ? 'required' : '',
        //     ],
        //     [
        //         'pdf_file.required' => 'Please upload pdf file.',
        //         'choice_option.required' => 'Please select option.',
        //         'page_options.required' => 'Please select sign page option.',
        //         'signature_stamp_page.required' =>$request->input('page_options') === "single" ? 'Signature stamp insert page number' : '',
        //     ]
        // );

        $choice = $request->choice_option;
        switch ($choice) {
            case 'one':
                // Calling getEsignRequestXml() method
                $page_method_option = $request->page_options;
                if ($page_method_option == 'single') {
                    $sample_pdf = null;
                    if ($request->hasFile('pdf_file')) {
                        $file = $request->file('pdf_file');
                        $fileName = $file->getClientOriginalName();
                        $sample_pdf = $fileName;
                        $destinationPath = public_path('esign_new_pdf_api');
                        $file->move($destinationPath, $sample_pdf);
                    }
                    $sample_pdf_filename = pathinfo($sample_pdf, PATHINFO_FILENAME);
                    $sample_pdf_path = public_path('esign_new_pdf_api') . '/' . $sample_pdf;

                    $tick_image = public_path('esign_new\tick_imge.jpeg');
                    $certificate = public_path('esign_new\DS ZAPFIN TEKNOLOGIES PRIVATE LIMITED new.p12');
                    $esign_info = new EsignInfo();
                    $esign_info->name_of_signature = $request->name_show_signature;
                    $esign_info->location_of_signature = $request->location_show_signature;
                    $esign_info->reasone_for_signature = $request->reasone_for_signature;
                    $esign_info->signature_stamp_page = $request->signature_stamp_page;
                    $esign_info->pdf_file = $fileName;
                    $esign_info->created_at = Carbon::now();
                    $esign_info->updated_at = Carbon::now();
                    $esign_info->save();
                    $id = $esign_info->id;
                    $access_token = $request->access_token;
                    $url = url("reponses/{$id}/{$page_method_option}/{$access_token}");
                    $exist_filename = explode('_signedFinal', $fileName);
                    $exist_filenamewithExtention = implode($exist_filename);
                    $only_filename = explode('.pdf', $exist_filenamewithExtention);
                    $onlyFileName = implode($only_filename);
                    $existing_pdf = EsignSignaturePdf::Where('signature_pdf', 'LIKE', $onlyFileName . '%')
                        ->where('page_count', $request->signature_stamp_page)
                        ->get();
                    if (count($existing_pdf) == 1) {
                        //second signature
                        $getEsignoutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 205 0 120 60 "" "" 2>&1');
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf_api' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new_api.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } elseif (count($existing_pdf) == 2) {
                        //third signature
                        $getEsignoutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 355 0 120 60 "" "" 2>&1');
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf_api' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new_api.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } elseif (count($existing_pdf) == 3) {
                        //forth signature
                        $getEsignoutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 505 0 120 60 "" "" 2>&1');
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf_api' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new_api.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } else {
                        //first Signature
                        $getEsignoutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 55 0 120 60 "" "" 2>&1');
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf_api' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new_api.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    }
                }
                $sample_pdf = null;
                if ($request->hasFile('pdf_file')) {
                    $file = $request->file('pdf_file');
                    $fileName = $file->getClientOriginalName();
                    $sample_pdf = $fileName;
                    $destinationPath = public_path('esign_new_pdf_api');
                    $file->move($destinationPath, $sample_pdf);
                }
                $sample_pdf_filename = pathinfo($sample_pdf, PATHINFO_FILENAME);
                $sample_pdf_path = public_path('esign_new_pdf_api') . '/' . $sample_pdf;
                if (!File::exists($sample_pdf_path)) {
                    return response()->json(['error' => 'PDF not found'], 404);
                }
                $content = file_get_contents($sample_pdf_path);
                $numPages = preg_match_all('/\/Page\W/', $content);
                $pdfNumber = [];
                $formatedPageNumber = '';
                for ($i = 1; $i <= $numPages; $i++) {
                    $formatedPageNumber .= "$i-55,1,60,120;";
                }
                $myfile = fopen('esign_new\list.txt', 'w');
                fwrite($myfile, $formatedPageNumber);
                fclose($myfile);
                $tick_image = public_path('esign_new\tick_imge.jpeg');
                $certificate = public_path('esign_new\DS ZAPFIN TEKNOLOGIES PRIVATE LIMITED new.p12');
                $pdfCordinateWidthAndHeight_Path = public_path('esign_new\list.txt');
                $esign_info = new EsignInfo();
                $esign_info->name_of_signature = $request->name_show_signature;
                $esign_info->location_of_signature = $request->location_show_signature;
                $esign_info->reasone_for_signature = $request->reasone_for_signature;
                $esign_info->signature_stamp_page = $request->signature_stamp_page;
                $esign_info->pdf_file = $fileName;
                $esign_info->created_at = Carbon::now();
                $esign_info->updated_at = Carbon::now();
                $esign_info->save();
                $id = $esign_info->id;
                $access_token = $request->access_token;
                $url = url("reponses/{$id}/{$page_method_option}/{$access_token}");
                //first Signature
                $getEsignoutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\Multi_eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" "" "" "' . $pdfCordinateWidthAndHeight_Path . '" 2>&1');
                //return  $getEsignoutput;
                $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                $sample_pdf_request_xmlo = public_path('esign_new_pdf_api' . $sample_pdf_request_xml);
                $request_xml = file_get_contents($sample_pdf_request_xmlo);
                $html = view('e_sign_new_api.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                return response()->json(['e_sign_xml' => $html]);
            default:
                return response()->json(['e_unsign_xml' => '<span class="choice_text">You do not have selected </span>']);
        }
    }
    public function reponseUrl(Request $request, $id, $sign_method,$user_access_token)
    {
       
        $output = $request->msg;
        $myfile = fopen('esign_new\response.txt', 'w');
        fwrite($myfile, $output);
        fclose($myfile);
        return redirect()->route('getsign_document', ['id' => $id, 'sign_method' => $sign_method,'access_token'=>$user_access_token]);
    }
    public function getSignDocument($id, $sign_method,$access_token)
    {
     
         $user = User::where('access_token',$access_token)->first(); 
          if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'docboyzesign')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
          }
         if ($sign_method == 'single') {

            $esign_info = EsignInfo::where('id', $id)->first();
            $name_of_signature = $esign_info->name_of_signature;
            $location_of_signature = $esign_info->location_of_signature;
            $reasone_for_signature = $esign_info->reasone_for_signature;
            $pdf_file = $esign_info->pdf_file;
            $signature_stamp_insert_location = $esign_info->signature_stamp_page;
            //Get Sign
            $pdf_path = public_path('esign_new_pdf_api') . '\\' . $pdf_file;
            $response_path = public_path('esign_new\response.txt');
            $tick_image = public_path('esign_new\tick_imge.jpeg');

            $exist_filename = explode('_signedFinal', $pdf_file);
            $exist_filenamewithExtention = implode($exist_filename);
            $only_filename = explode('.pdf', $exist_filenamewithExtention);
            $onlyFileName = implode($only_filename);
            $existing_pdf = EsignSignaturePdf::Where('signature_pdf', 'LIKE', $onlyFileName . '%')
                ->where('page_count', $signature_stamp_insert_location)
                ->get();

            if (count($existing_pdf) == 1) {
                //second signature
                $getEsignDocumentOutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 205 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf_api') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf_api/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs899@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new_api.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf_api/' . $final_signed_pdf_filename);
                    if($user->role_id==1){
                        if ($apiamster) {
                           $this->saveHitCount($user->id,$api_id,'Transaction Success.',200);
                        }
                    }
                    return view('e_sign_new_api.getFinalSignedDocument', compact('download_pdf','access_token'));
                }
                if($user->role_id==1){
                    if ($apiamster) {
                       $this->saveHitCount($user->id,$api_id,'Transaction Failed.',102);
                    }
                }
                return response()->json(['status_code'=>102,'message' => 'Something is Wrong.']);
            } elseif (count($existing_pdf) == 2) {
                //third signature
                $getEsignDocumentOutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 355 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf_api') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf_api/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs899@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new_api.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf_api/' . $final_signed_pdf_filename);
                  if($user->role_id==1){
                        if ($apiamster) {
                           $this->saveHitCount($user->id,$api_id,'Transaction Success.',200);
                        }
                    }
                    return view('e_sign_new_api.getFinalSignedDocument', compact('download_pdf','access_token'));
                }
                if($user->role_id==1){
                    if ($apiamster) {
                       $this->saveHitCount($user->id,$api_id,'Transaction Failed.',102);
                    }
                }
                return response()->json(['status_code'=>102,'message' => 'Something is Wrong.']);
            } elseif (count($existing_pdf) == 3) {
                //third signature
                $getEsignDocumentOutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 505 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf_api') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf_api/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs899@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new_api.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf_api/' . $final_signed_pdf_filename);
                    if($user->role_id==1){
                        if ($apiamster) {
                           $this->saveHitCount($user->id,$api_id,'Transaction Success.',200);
                        }
                    }
                    return view('e_sign_new_api.getFinalSignedDocument', compact('download_pdf','access_token'));
                }
                if($user->role_id==1){
                    if ($apiamster) {
                       $this->saveHitCount($user->id,$api_id,'Transaction Failed.',102);
                    }
                }
                return response()->json(['status_code'=>102,'message' => 'Something is Wrong.']);
            } else {
                //first signature
                $getEsignDocumentOutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\eSign2.1.jar" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 55 0 120 60 "" "" -o "output.pdf" 2>&1');
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf_api') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf_api/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs899@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new_api.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf_api/' . $final_signed_pdf_filename);
                    if($user->role_id==1){
                        if ($apiamster) {
                           $this->saveHitCount($user->id,$api_id,'Transaction Success.',200);
                        }
                    }
                    return view('e_sign_new_api.getFinalSignedDocument', compact('download_pdf','access_token'));
                }
                if($user->role_id==1){
                    if ($apiamster) {
                       $this->saveHitCount($user->id,$api_id,'Transaction Failed.',102);
                    }
                }
                return response()->json(['status_code'=>102,'message' => 'Something is Wrong.']);
            }
        }
        $esign_info = EsignInfo::where('id', $id)->first();
        $name_of_signature = $esign_info->name_of_signature;
        $location_of_signature = $esign_info->location_of_signature;
        $reasone_for_signature = $esign_info->reasone_for_signature;
        $pdf_file = $esign_info->pdf_file;
        $signature_stamp_insert_location = $esign_info->signature_stamp_page;
        //Get Sign
        $pdf_path = public_path('esign_new_pdf_api') . '\\' . $pdf_file;
        $response_path = public_path('esign_new\response.txt');
        $tick_image = public_path('esign_new\tick_imge.jpeg');
        $pdfCordinateWidthAndHeight_Path = public_path('esign_new\list.txt');
        $getEsignDocumentOutput = shell_exec('"C:\Program Files\Java\jdk-1.8\bin\java.exe" -jar "C:\Multi_eSign2.1.jar" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" "" "" "' . $pdfCordinateWidthAndHeight_Path . '" 2>&1');
        $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
        $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
        $signature_pdf_file = new EsignSignaturePdf();
        $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
        $signature_pdf_file->page_count = $signature_stamp_insert_location;
        $signature_pdf_file->created_at = Carbon::now();
        $signature_pdf_file->updated_at = Carbon::now();
        $signature_pdf_file->save();
        $final_signed_pdf_path = public_path('esign_new_pdf_api') . '\\' . $final_signed_pdf_filename;
        if (file_exists($final_signed_pdf_path)) {
            // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf_api/' . $final_signed_pdf_filename)];
            // $email = 'maheshkrs899@gmail.com';
            // $subject = 'Regtech Esign';
            // Mail::send('e_sign_new_api.getSignedPdf', $data, function ($message) use ($email, $subject) {
            //     $message->to($email)->subject($subject);
            // });
            $download_pdf = asset('esign_new_pdf_api/' . $final_signed_pdf_filename);
            if($user->role_id==1){
                if ($apiamster) {
                   $this->saveHitCount($user->id,$api_id,'Transaction Success.',200);
                }
            }
            return view('e_sign_new_api.getFinalSignedDocument', compact('download_pdf','access_token'));
        }
        if($user->role_id==1){
            if ($apiamster) {
               $this->saveHitCount($user->id,$api_id,'Transaction Failed.',102);
            }
        }
        return response()->json(['status_code'=>102,'message' => 'Something is Wrong.']);
    }
}
