<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EsignInfo;
use App\Models\EsignSignaturePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use File;
class EsignController extends Controller
{
  
    public function index(Request $request)
    {
        return view('e_sign_new.index');
    }
    public function GenerateEsignXml(Request $request)
    {
        $request->validate(
            [
                'pdf_file' => 'required|mimes:pdf',
                'name_show_signature' => 'required',
                'location_show_signature' => 'required',
                'reasone_for_signature' => 'required',
                'choice_option' => 'required',
                'page_options' => 'required',
                'signature_stamp_page' => $request->input('page_options') === "single" ? 'required' : '',
            ],
            [
                'pdf_file.required' => 'Please upload pdf file.',
                'choice_option.required' => 'Please select option.',
                'page_options.required' => 'Please select sign page option.',
                'signature_stamp_page.required' =>$request->input('page_options') === "single" ? 'Signature stamp insert page number' : '',
            ]
        );

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
                        $destinationPath = public_path('esign_new_pdf');
                        $file->move($destinationPath, $sample_pdf);
                    }
                    $sample_pdf_filename = pathinfo($sample_pdf, PATHINFO_FILENAME);
                    $sample_pdf_path = public_path('esign_new_pdf') . '/' . $sample_pdf;

                    $tick_image = public_path('esign_new/tick_imge.jpeg');
                    $certificate = public_path('esign_new/DS ZAPFIN TEKNOLOGIES PRIVATE LIMITED new.p12');
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
                    $url = 'https://dev.regtechapi.in/reponse_new/'.$id.'/'.$page_method_option;
                    // $url = url("reponse_new/{$id}/{$page_method_option}");
                    $exist_filename = explode('_signedFinal', $fileName);
                    $exist_filenamewithExtention = implode($exist_filename);
                    $only_filename = explode('.pdf', $exist_filenamewithExtention);
                    $onlyFileName = implode($only_filename);
                    $existing_pdf = EsignSignaturePdf::Where('signature_pdf', 'LIKE', $onlyFileName . '%')
                        ->where('page_count', $request->signature_stamp_page)
                        ->get();
                    if (count($existing_pdf) == 1) {
                        //second signature
                        $getEsignoutput = shell_exec('java -jar "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 205 0 120 60 "" "" 2>&1');
                        return $getEsignoutput;
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } elseif (count($existing_pdf) == 2) {
                        //third signature
                        $getEsignoutput = shell_exec('java -jar "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 355 0 120 60 "" "" 2>&1');
                        return $getEsignoutput;
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } elseif (count($existing_pdf) == 3) {
                        //forth signature
                        $getEsignoutput = shell_exec('java -jar "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 505 0 120 60 "" "" 2>&1');
                        return $getEsignoutput;
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    } else {
                        //first Signature
                        // echo "Current server time: " . date("Y-m-d H:i:s");
                        $javaPath = "/usr/bin/java";
                        $jarPath = "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar";
                        // $getEsignoutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 55 0 120 60 "" "" 2>&1');
                        // echo $getEsignoutput;
                        // return $getEsignoutput;
                        $getEsignoutput = shell_exec('java -jar "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" ' . $request->signature_stamp_page . ' "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" 55 0 120 60 "" "" 2>&1');
                        return $getEsignoutput;
                        // dd($getEsignoutput);
                       
                        $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                        $sample_pdf_request_xmlo = public_path('esign_new_pdf' . $sample_pdf_request_xml);
                        $request_xml = file_get_contents($sample_pdf_request_xmlo);
                        $html = view('e_sign_new.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                        return response()->json(['e_sign_xml' => $html]);
                    }
                }
                $sample_pdf = null;
                if ($request->hasFile('pdf_file')) {
                    $file = $request->file('pdf_file');
                    $fileName = $file->getClientOriginalName();
                    $sample_pdf = $fileName;
                    $destinationPath = public_path('esign_new_pdf');
                    $file->move($destinationPath, $sample_pdf);
                }
                $sample_pdf_filename = pathinfo($sample_pdf, PATHINFO_FILENAME);
                $sample_pdf_path = public_path('esign_new_pdf') . '/' . $sample_pdf;
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
                $myfile = fopen('esign_new/list.txt', 'w');
                fwrite($myfile, $formatedPageNumber);
                fclose($myfile);
                // $tick_image = public_path('esign_new\tick_imge.jpeg');
                $tick_image = public_path('esign_new/tick_imge.jpeg');
                // $certificate = public_path('esign_new\DS ZAPFIN TEKNOLOGIES PRIVATE LIMITED new.p12');
                $certificate = public_path('esign_new/DS ZAPFIN TEKNOLOGIES PRIVATE LIMITED new.p12');
                $pdfCordinateWidthAndHeight_Path = public_path('esign_new/list.txt');
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
                $url = url("reponse_new/{$id}/{$page_method_option}");
                //first Signature
                $getEsignoutput = shell_exec('java -jar "/var/www/html/regtechapinew/public/esign_jar/Multi_eSign2.1.jar" 1 "" "' . $sample_pdf_path . '" "ASPZTPLUAT007191" 1 "' . $url . '" "' . $certificate . '" "123456" "' . $tick_image . '" 15 "imported certificate" "' . $request->name_show_signature . '" "' . $request->location_show_signature . '" "' . $request->reasone_for_signature . '" "" "" "' . $pdfCordinateWidthAndHeight_Path . '" 2>&1');
                return $getEsignoutput;
                //return  $getEsignoutput;
                $sample_pdf_request_xml = '/' . $sample_pdf_filename . '_eSignRequestXml.txt';
                $sample_pdf_request_xmlo = public_path('esign_new_pdf' . $sample_pdf_request_xml);
                $request_xml = file_get_contents($sample_pdf_request_xmlo);
                $html = view('e_sign_new.getE_signRequestXml', compact('getEsignoutput', 'request_xml'))->render();
                return response()->json(['e_sign_xml' => $html]);
            default:
                return response()->json(['e_unsign_xml' => '<span class="choice_text">You do not have selected </span>']);
        }
    }
    public function reponseUrl(Request $request, $id, $sign_method)
    {
       
        $output = $request->msg;
        $myfile = fopen('/var/www/html/regtechapinew/public/esign_new/response.txt', 'w');
        fwrite($myfile, $output);
        fclose($myfile);
        return redirect()->route('getsign.document', ['id' => $id, 'sign_method' => $sign_method]);
    }
    public function getSignDocument($id, $sign_method)
    {
        if ($sign_method == 'single') {

            $esign_info = EsignInfo::where('id', $id)->first();
            // return $esign_info;
            $name_of_signature = $esign_info->name_of_signature;
            // return $name_of_signature;
            $location_of_signature = $esign_info->location_of_signature;
            $reasone_for_signature = $esign_info->reasone_for_signature;
            $pdf_file = $esign_info->pdf_file;
            $signature_stamp_insert_location = $esign_info->signature_stamp_page;
            //Get Sign
            // $pdf_path = public_path('esign_new_pdfsa') . '/' . $pdf_file;
            // $url = 'https://dev.regtechapi.in/reponse_new/'.$id.'/'.$page_method_option;
            $pdf_path = public_path('esign_new_pdf') . '/' . $pdf_file;
            //   if (File::exists($pdf_path)) {
            //         return 'pdf_path';
            //     } else {
            //         return 'no';
            //     }
           
            // $pdf_path = '/var/www/html/regtechapinew/public/esign_new_pdf'.'/'.$pdf_file;
            // return $pdf_path;
            // $response_path = public_path('esign_new/response.txt');
            $response_path = '/var/www/html/regtechapinew/public/esign_new/response.txt';
            // $tick_image = public_path('esign_new/tick_imge.jpeg');
            $tick_image = public_path('esign_new/tick_imge.jpeg');
           
            // $tick_image = '/var/www/html/regtechapinew/public/esign_new/tick_imge.jpeg';

            $exist_filename = explode('_signedFinal', $pdf_file);
            $exist_filenamewithExtention = implode($exist_filename);
            $only_filename = explode('.pdf', $exist_filenamewithExtention);
            $onlyFileName = implode($only_filename);
            $existing_pdf = EsignSignaturePdf::Where('signature_pdf', 'LIKE', $onlyFileName . '%')
                ->where('page_count', $signature_stamp_insert_location)
                ->get();
            // return $reasone_for_signature;

            if (count($existing_pdf) == 1) {
                $javaPath = "/usr/bin/java";
                $jarPath = "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar";
                $getEsignDocumentOutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 205 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf/' . $final_signed_pdf_filename)];
                    $email = 'maheshkrs799@gmail.com';
                    $subject = 'Regtech Esign';
                    Mail::send('e_sign_new.getSignedPdf', $data, function ($message) use ($email, $subject) {
                        $message->to($email)->subject($subject);
                    });
                    $download_pdf = asset('esign_new_pdf/' . $final_signed_pdf_filename);
                    //  return response()->download($final_signed_pdf_path, $final_signed_pdf_filename,['Content-Type' => 'application/pdf']);
                    return view('e_sign_new.getFinalSignedDocument', compact('download_pdf'));
                }
                return response()->json(['message' => 'Authorization filed.']);
            } elseif (count($existing_pdf) == 2) {
                //third signature
                $javaPath = "/usr/bin/java";
                $jarPath = "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar";
                $getEsignDocumentOutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 355 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs799@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf/' . $final_signed_pdf_filename);
                    //  return response()->download($final_signed_pdf_path, $final_signed_pdf_filename,['Content-Type' => 'application/pdf']);
                    return view('e_sign_new.getFinalSignedDocument', compact('download_pdf'));
                }
                return response()->json(['message' => 'Authorization filed.']);
            } elseif (count($existing_pdf) == 3) {
                //third signature
                $javaPath = "/usr/bin/java";
                $jarPath = "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar";
                $getEsignDocumentOutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 505 0 120 60 "" "" -o "output.pdf" 2>&1');
                // return  $getEsignDocumentOutput;
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf') . '\\' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs799@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf/' . $final_signed_pdf_filename);
                    //  return response()->download($final_signed_pdf_path, $final_signed_pdf_filename,['Content-Type' => 'application/pdf']);
                    return view('e_sign_new.getFinalSignedDocument', compact('download_pdf'));
                }
                return response()->json(['message' => 'Authorization filed.']);
            } else {
                //first signature
                $javaPath = "/usr/bin/java";
                 
                $jarPath = "/var/www/html/regtechapinew/public/esign_jar/eSign2.1.jar";
                
                $getEsignDocumentOutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 ' . $signature_stamp_insert_location . ' "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" 55 0 120 60 "" "" -o "output.pdf" 2>&1');
                $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
                $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
                $signature_pdf_file = new EsignSignaturePdf();
                $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
                $signature_pdf_file->page_count = $signature_stamp_insert_location;
                $signature_pdf_file->created_at = Carbon::now();
                $signature_pdf_file->updated_at = Carbon::now();
                $signature_pdf_file->save();
                $final_signed_pdf_path = public_path('esign_new_pdf') . '/' . $final_signed_pdf_filename;

                if (file_exists($final_signed_pdf_path)) {
                    // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf/' . $final_signed_pdf_filename)];
                    // $email = 'maheshkrs799@gmail.com';
                    // $subject = 'Regtech Esign';
                    // Mail::send('e_sign_new.getSignedPdf', $data, function ($message) use ($email, $subject) {
                    //     $message->to($email)->subject($subject);
                    // });
                    $download_pdf = asset('esign_new_pdf/' . $final_signed_pdf_filename);
                    //  return response()->download($final_signed_pdf_path, $final_signed_pdf_filename,['Content-Type' => 'application/pdf']);
                    return view('e_sign_new.getFinalSignedDocument', compact('download_pdf'));
                }
                return response()->json(['message' => 'Authorization filedsseff.']);
            }
        }
        $javaPath = "/usr/bin/java";  
        $jarPath = "/var/www/html/regtechapinew/public/esign_jar/Multi_eSign2.1.jar";

        $esign_info = EsignInfo::where('id', $id)->first();
        $name_of_signature = $esign_info->name_of_signature;
        $location_of_signature = $esign_info->location_of_signature;
        $reasone_for_signature = $esign_info->reasone_for_signature;
        $pdf_file = $esign_info->pdf_file;
        $signature_stamp_insert_location = $esign_info->signature_stamp_page;
        //Get Sign
        // $pdf_path = public_path('esign_new_pdf') . '\\' . $pdf_file;
        $pdf_path = public_path('esign_new_pdf') . '/' . $pdf_file;
        // $response_path = public_path('esign_new\response.txt');
        $response_path = '/var/www/html/regtechapinew/public/esign_new/response.txt';
        // $tick_image = public_path('esign_new\tick_imge.jpeg');
        $tick_image = public_path('esign_new/tick_imge.jpeg');
        // $pdfCordinateWidthAndHeight_Path = public_path('esign_new\list.txt');
        $pdfCordinateWidthAndHeight_Path = '/var/www/html/regtechapinew/public/esign_new/list.txt';

        $getEsignDocumentOutput = shell_exec('"'.$javaPath.'" -jar "'.$jarPath.'" 2 "' . $response_path . '" "' . $pdf_path . '" "' . $tick_image . '" 15 "' . $name_of_signature . '" "' . $location_of_signature . '" "' . $reasone_for_signature . '" "" "" "' . $pdfCordinateWidthAndHeight_Path . '" 2>&1');
        $signed_pdf_filename = pathinfo($pdf_file, PATHINFO_FILENAME);
        $final_signed_pdf_filename = $signed_pdf_filename . '_signedFinal' . '.' . 'pdf';
        $signature_pdf_file = new EsignSignaturePdf();
        $signature_pdf_file->signature_pdf = $final_signed_pdf_filename;
        $signature_pdf_file->page_count = $signature_stamp_insert_location;
        $signature_pdf_file->created_at = Carbon::now();
        $signature_pdf_file->updated_at = Carbon::now();
        $signature_pdf_file->save();
        $final_signed_pdf_path = public_path('esign_new_pdf') . '/' . $final_signed_pdf_filename;
        if (file_exists($final_signed_pdf_path)) {
            // $data = ['title' => 'Regtech Signature', 'name' => 'RegTech API', 'pdf_link' => asset('esign_new_pdf/' . $final_signed_pdf_filename)];
            // $email = 'maheshkrs799@gmail.com';
            // $subject = 'Regtech Esign';
            // Mail::send('e_sign_new.getSignedPdf', $data, function ($message) use ($email, $subject) {
            //     $message->to($email)->subject($subject);
            // });
            $download_pdf = asset('esign_new_pdf/' . $final_signed_pdf_filename);
            // //  return response()->download($final_signed_pdf_path, $final_signed_pdf_filename,['Content-Type' => 'application/pdf']);
            return view('e_sign_new.getFinalSignedDocument', compact('download_pdf'));
        }
        return response()->json(['message' => 'Authorization filed.']);
    }
}
