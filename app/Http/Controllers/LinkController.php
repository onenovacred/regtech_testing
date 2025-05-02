<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\consumer;
use App\Models\businesskyc;
use App\Models\businesstype;
use App\Models\business;
use App\Models\requireddetails;
use App\Models\rulesdefined;
use App\Models\termscondition;
use App\Models\congratulations;
use App\Models\agreementpolicy;
use App\Models\bankdetails;
use App\Models\link;
use Auth;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Mail;
use App\Models\documentname;
use Barryvdh\DomPDF\Facade\Pdf;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        //$consumerid = $request->session()->get('consumerid');
        // $url="http://localhost/projects/regtechapi/public/";
        $url = "https://regtechapi.in/public/";
        $consumerid = $request->id;
        $businesskycid=array();
        $documentname=array();
        $documentdetail = array();
        $businesstypeid = array();
        $consumer= consumer::where('id',$consumerid)->get();
        $business = business::where('customerid',$consumerid)->get();
        if($business->count() > 0)
        {
            foreach($business as $businesses)
            {
            }
            if($businesses->businesskycid!=null)
            {
                $businesskycid = businesskyc::where('id',$businesses->businesskycid)->get();
            }
            if($businesses->businesstypeid!=null)
            {
                $businesstypeid = businesstype::where('id',$businesses->businesstypeid)->get();
            }
        }
        $requireddetails = requireddetails::where('customerid',$consumerid)->get();
        if($requireddetails->count() > 0)
        {
            foreach($requireddetails as $requireddetail)
            {
            }
            if($requireddetail->documentdetailsid!=null)
            {
                $documentname = documentname::where('id',$requireddetail->documentdetailsid)->get();
            }
        }
        $termscondition = termscondition::where('customerid',$consumerid)->get();
        $congratulations = congratulations::where('customerid',$consumerid)->get();
        $bankdetails = bankdetails::where('customerid',$consumerid)->get();
        $requireddetails = requireddetails::where('customerid',$consumerid)->get();
        $termscondition = termscondition::where('customerid',$consumerid)->get();
        $congratulations = congratulations::where('customerid',$consumerid)->get();
        $agreementpolicy = agreementpolicy::where('customerid',$consumerid)->get();
        $bankdetails = bankdetails::where('customerid',$consumerid)->get();
        // echo $consumer->firstname;
        // // print_r($consumer);
        // exit(1);
        // $pdf = PDF::loadView('consumer.linkpdf',compact('consumer','business','requireddetails','termscondition','congratulations','bankdetails','businesskycid','businesstypeid','termscondition','congratulations','agreementpolicy','bankdetails','documentname','url'))->setPaper('A4');
        // return $pdf->download('pdf.pdf');
        //  return $pdf->stream('invoice.pdf');
         return view('consumer.link',compact('consumer','business','requireddetails','termscondition','congratulations','bankdetails','businesskycid','businesstypeid','termscondition','congratulations','agreementpolicy','bankdetails','documentname','url'));
    }
    public function exportdownload(Request $request)
    {
        $url = "https://regtechapi.in/public/";
        $consumerid = $request->id;
        $businesskycid=array();
        $documentname=array();
        $documentdetail = array();
        $businesstypeid = array();
        $consumer= consumer::where('id',$consumerid)->get();
        $business = business::where('customerid',$consumerid)->get();
        if($business->count() > 0)
        {
            foreach($business as $businesses)
            {
            }
            if($businesses->businesskycid!=null)
            {
                $businesskycid = businesskyc::where('id',$businesses->businesskycid)->get();
            }
            if($businesses->businesstypeid!=null)
            {
                $businesstypeid = businesstype::where('id',$businesses->businesstypeid)->get();
            }
        }
        $requireddetails = requireddetails::where('customerid',$consumerid)->get();
        if($requireddetails->count() > 0)
        {
            foreach($requireddetails as $requireddetail)
            {
            }
            if($requireddetail->documentdetailsid!=null)
            {
                $documentname = documentname::where('id',$requireddetail->documentdetailsid)->get();
            }
        }
        $termscondition = termscondition::where('customerid',$consumerid)->get();
        $congratulations = congratulations::where('customerid',$consumerid)->get();
        $bankdetails = bankdetails::where('customerid',$consumerid)->get();
        $requireddetails = requireddetails::where('customerid',$consumerid)->get();
        $termscondition = termscondition::where('customerid',$consumerid)->get();
        $congratulations = congratulations::where('customerid',$consumerid)->get();
        $agreementpolicy = agreementpolicy::where('customerid',$consumerid)->get();
        $bankdetails = bankdetails::where('customerid',$consumerid)->get();
        view()->share('consumer', $consumer);
        view()->share('business',$business);
        view()->share('requireddetails',$requireddetails);
        view()->share('termscondition',$termscondition);
        view()->share('congratulations',$congratulations);
        view()->share('bankdetails',$bankdetails);
        view()->share('businesskycid',$businesskycid);
        view()->share('businesstypeid',$businesstypeid);
        view()->share('businesstypeid',$businesstypeid);
        view()->share('businesstypeid',$businesstypeid);
        // echo $consumer->firstname;
        // // print_r($consumer);
        // exit(1);
         $pdf = PDF::loadView('consumer.linkpdf',compact('consumer','url'))->setPaper('A4');
         //return $pdf->download('pdf.pdf');
         return $pdf->stream('invoice.pdf');
    }
}
