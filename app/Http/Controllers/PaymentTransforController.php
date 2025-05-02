<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
class PaymentTransforController extends Controller
{
    //
    public function initiateTransaction(){
       try{
    //     $salt = "YLVD3RJJ4N";
    //     $key = "A2OEHVZPKS";
    //     $beneficiary_code=$this->generateBeneficiaryCode();
    //     $unique_request_number= $this->generateRequestNumber();
    //     $virtual_account_number="100001000000xxxxx";
    //     $amount=1.00;
    //     $client = new Client();
    //     $genarate_auth_key=$key.'|'.$beneficiary_code.'|'.$unique_request_number.'|'.$amount.'|'.$salt;
    //     $authorization = hash('sha512',$genarate_auth_key);
    //     $response = $client->request('POST', 'https://wire.easebuzz.in/api/v1/transfers/initiate/', [
    //     'body' =>json_encode([
    //     "key"=>$key,
    //     "virtual_account_number"=> $virtual_account_number,
    //     "beneficiary_code"=>$beneficiary_code,
    //     "unique_request_number"=>$unique_request_number,
    //     "payment_mode"=>"IMPS",
    //     "amount"=>$amount,
    //     "narration"=> "Testinitiatetransfer",
    //     "udf1"=>"Initiatetransfertest"
    //   ],JSON_PRETTY_PRINT),
    //    'headers' => [
    //    'Accept' => 'application/json',
    //    'Authorization' =>'Bearer'.$authorization,
    //    'Content-Type' => 'application/json',
    //    'WIRE-API-KEY' => '',
    //   ],
    //  ]);
    //    $data = json_decode($response->getBody(),true);
    //    return response()->json(['data'=>$data,'status_code'=>200]);
    $salt = "F926283159";
    $key = "D0430E5D60";
    $beneficiary_code = $this->generateBeneficiaryCode();
    $unique_request_number = $this->generateRequestNumber();
    $virtual_account_number = "100001000000xxxxx";
    $amount = 1.00;

    $genarate_auth_key = $key . '|' . $beneficiary_code . '|' . $unique_request_number . '|' . $amount . '|' . $salt;
    $authorization = hash('sha512', $genarate_auth_key);

    $postData = [
        "key" => $key,
        "virtual_account_number" => $virtual_account_number,
        "beneficiary_code" => $beneficiary_code,
        "unique_request_number" => $unique_request_number,
        "payment_mode" => "IMPS",
        "amount" => $amount,
        "narration" => "Testinitiatetransfer",
        "udf1" => "Initiatetransfertest"
    ];

    $ch = curl_init('https://wire.easebuzz.in/api/v1/transfers/initiate/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Authorization:'.$authorization,
        'Content-Type: application/json',
        'WIRE-API-KEY:D0430E5D60'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData, JSON_PRETTY_PRINT));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch), curl_getinfo($ch, CURLINFO_HTTP_CODE));
    }

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);
    return response()->json(['data' => $data, 'status_code' => $statusCode]);
     }catch(RequestException $exception){
      $statusCode = $exception->getResponse()->getStatusCode();
      $response = $exception->getResponse();
      return response()->json(['status_code'=>$statusCode,'response'=>$response]);
    }
      
 }
 function generateBeneficiaryCode($prefix = 'bene', $length = 32) {
   $randomString = bin2hex(random_bytes(($length - strlen($prefix)) / 2));
  return $prefix . $randomString;
 }
 function generateRequestNumber(){
  $requestNumber= strval(rand(1000000,10000));
  return $requestNumber;
 }
}
