<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Async;
use Session;
use Exception;
use Carbon\Carbon;
use App\Models\OTP;
use App\Models\link;
use App\Models\User;
use GuzzleHttp\Psr7;
use App\Models\crifdb;
use App\Models\Rcfull;
use GuzzleHttp\Client;
use App\Models\business;
use App\Models\consumer;
use App\Models\ApiMaster;
use App\Models\bankdetails;
use App\Models\businesskyc;
use App\Models\Transaction;
use App\Models\businesstype;
use App\Models\documentname;
use App\Models\rulesdefined;
use App\Models\SchemeMaster;
use App\Models\HitCountMaster;
use App\Models\termscondition;
use App\Models\agreementpolicy;
use App\Models\congratulations;
use App\Models\requireddetails;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserSchemeMaster;
use App\Models\{Post, RegtechBlog};
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;

class ApiController3 extends Controller
{
  private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
  // private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
  private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
  private $base_url = 'https://kyc-api.flowboard.in/api/v1';
  private $base_urln = 'https://api.signzy.app/api/v3';
  // private $signzytoken = 'quaX7XBUjg4S8ITGJeWrhbQ86YakeNOr';
  private $signzytoken = 'nSMWQHptp8JAaROQjhtUKPnrP3mviY6R';
  private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

  //Equifax
  // private $equifax_url = "https://eportuat.equifax.co.in/cir360Report/cir360Report";
  //   private $equifax_url = "https://ists.equifax.co.in/cir360service/cir360report";
  private $equifax_url = "https://6lzpgvkn3f.execute-api.ap-south-1.amazonaws.com/equifax/score";
  // private $equifax_url = "https://bo6dqokjja.execute-api.ap-south-1.amazonaws.com/equifax/score";

  // private $equifax_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2NjAxMTEyMTN9.d6TecpM6LWgp91bjAjYQvUCdtjSxTX4RDEnY_Qc3lgc";
  //Crif
  private $crif_url = "https://loantap.in/affiliate/apiv1-1/docboyz/crif";

  private $smartship_url = 'http://api.smartship.in'; //'http://oauth.smartship.in';

  private $api_club = 'https://api.apiclub.in/api';
  private $api_clubli = 'https://api.apiclub.in/uat/v1';

  private $api_club_key = '2487be27f4d20bc1d366cb38f098eba7';

  private $secretKey = 'pI76u95BabjkIFg6DNNRole7gZn71ljPk7W5WIHzApjlObIMywuq8pZGa30HXm5wR';

  private $equifaxsecretKey = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwiaWF0IjoxNjkzMzEyNTg2OTc4fQ.mMgl0deNRbkCXT0LnE8t7hRbTkwoK9TbnCrAS-TtjR4';

  private $clientId = 'ef41c6d7089614d1838c68efc81a8493:dc983c1bfbc4390f4952bd44ed0ae690';

  private $ckyctoken = 'gG9WM8pp2TDZ7DvnNNpqSnNXY7tSntiW';

  private $site_url = 'http://regtechapi.in';

  private $nsdlToken = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwibmFtZSI6IkFTSE9LIEtVTUFSIiwiaWF0IjoxNjY2MjM5MDIyfQ.ZuHUPDZhHtnkDHUrKwuwOuUYBqj4Kp0SRnJqiFWHVfs';

  // Get Access Token
  public function getAccessToken(Request $request)
  {
    $statusCode = null;
    $access_token = null;

    if (empty($request->email))
      return response()->json(array(['message' => 'Email id is required', 'statusCode' => '404']));

    if (empty($request->password))
      return response()->json(array(['message' => 'Password is required', 'statusCode' => '404']));

    $email = $request->email;
    $password = $request->password;

    $user = User::where('email', $request->email)->first();
    if (!$user)
      return response()->json(array(['message' => 'Email ID not associated with us', 'statusCode' => '403']));

    if (!Hash::check($password, $user->password)) {
      return response()->json(array(['message' => 'Wrong Credentials', 'statusCode' => '401']));
    }


    return response()->json(array(['access_token' => $user->access_token, 'statusCode' => '200']));
  }

  // Verify Access Token
  public function verifyAccessToken($access_token)
  {
    $user = User::where('access_token', $access_token)->count();
    if ($user > 0)
      return true;
    else
      return false;
  }

  // Save To hit_count_master table
  public function saveHitCount($user_id, $api_id, $remark, $statusCode)
  {
    $cnt200 = 0;
    $cnt400 = 0;
    $cnt101 = 0;
    $payableHits = 0;
    $scheme_price = 0;
    $total_amount = 0;
    $updateHitCount = UserSchemeMaster::where('user_id', $user_id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    $payment_slab = explode(',', $updateHitCount->payment_slab);
    $scheme_prices = explode(',', $updateHitCount->scheme_price);
    // $transactions = Transaction::where('user_id', $user_id)->where('api_id',$api_id)->where('hit_year_month', date('Y-m'))->get();
    $transactions = Transaction::where('user_id', $user_id)->where('api_id', $api_id)->where('hit_year_month', date('Y-m'))->count();
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
        if ($i == (count($payment_slab) - 1)) {
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
      'total_transaction_amount_per_api' => $total_amount
    ]);

    $addHitCount = new HitCountMaster;
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
    $transaction = new Transaction;
    $transaction->transaction_id = $this->transaction_id();
    $transaction->user_id = $user_id;
    $transaction->api_id = $api_id; //work
    $transaction->type_creditdebit = 'Debit';
    $transaction->hit_year_month = date('Y-m');
    $transaction->scheme_price = $amount;  //work
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
  public function bankAnalyser(Request $request)
  {
    $api_id = null;
    if (!$request->hasFile('bankStemt')) {
      return json_encode(['message' => "file not found"], true);
    }
    if (!$request->headers->has('AccessToken'))
      return response()->json(array(['message' => 'Header Access Token is required', 'statusCode' => '404']));
    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false)
      return response()->json(array(['message' => 'Wrong Access Token', 'statusCode' => '403']));

    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'bank_anlyser')->first();
      if ($apiamster)
        $api_id = $apiamster->id;

    }
    $client = new Client();
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://13.127.202.182:8080/analyser',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => [
            'pdf' => new \CURLFILE($_FILES['bankStemt']['tmp_name'], $_FILES['bankStemt']['type'], $_FILES['bankStemt']['name']),
            'bankName' => $request->bankName,
            'accountType' => $request->accountType,
            'password' => $request->password
          ],
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $bank_analyser = json_decode($response, true);
        if ((isset($bank_analyser['statuscode']) && $bank_analyser['statuscode'] == 200) && isset($bank_analyser['Data']['average_balance'])) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
          }
          $bankName = $request->bankName;
          $bankAnalyser = $bank_analyser['Data'];
          $bankfinalanalyserResponse = null;
          switch ($bankName) {
            case 'ICICI Bank':
              if (isset($bankAnalyser['withdrawal_transactions'])) {
                $atmwithdrawls = [];
                foreach ($bankAnalyser['withdrawal_transactions'] as $k => $response) {
                  $normilizeatmwithdrawls = [
                    'amount' => isset($response['BALANCE']) ? $response['BALANCE'] : null,
                    'bank' => null,
                    'date' => isset($response['DATE']) ? $response['DATE'] : null,
                    'description' => isset($response['PARTICULARS']) ? $response['PARTICULARS'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'total' => null,

                  ];
                  $atmwithdrawls[$k] = $normilizeatmwithdrawls;
                }
              } else {
                $atmwithdrawls = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $average_Monthlybalance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilizeaverageMonthlyBalance = [
                    'netAverageBalance' => isset($response['BALANCE Average']) ? $response['BALANCE Average'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'dayBalanceMap' => null,
                  ];
                  $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
                }

              } else {
                $average_Monthlybalance = [];
              }
              if (isset($bankAnalyser['deposit_transactions'])) {
                $cash_deposits = [];
                foreach ($bankAnalyser['deposit_transactions'] as $k => $response) {
                  $normilized_cashdeposits = [
                    "amount" => isset($response['BALANCE']) ? $response['BALANCE'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => isset($response['DATE']) ? $response['DATE'] : null,
                    "description" => isset($response['PARTICULARS']) ? $response['PARTICULARS'] : null,
                    "mode" => isset($response['MODE']) ? $response['MODE'] : null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ];
                  $cash_deposits[$k] = $normilized_cashdeposits;
                }
              } else {
                $cash_deposits = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $minimum_balance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilized_minimum_balance = [
                    "amount" => isset($response['BALANCE Minimum']) ? $response['BALANCE Minimum'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionType" => null
                  ];
                  $minimum_balance[$k] = $normilized_minimum_balance;
                }
              } else {
                $minimum_balance = [];
              }
              $bankfinalanalyserResponse = [
                "atm_withdrawls" => $atmwithdrawls,
                "averageMonthlyBalance" => $average_Monthlybalance,
                "averageQuarterlyBalance" => [
                  [
                    "netAverageBalance" => null,
                    "monthAndYear" => null,
                  ],
                ],
                "bank_account" => [
                  "accountDetailsForAccountListPage" => null,
                  "accountHolder" => "[]",
                  "accountLimit" => null,
                  "accountNo" => null,
                  "accountType" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "address" => "[]",
                  "availableCashLimit" => null,
                  "availableCreditLimit" => null,
                  "bank" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "bankAccountUID" => null,
                  "bankAddress" => null,
                  "bankCredentialCO" => null,
                  "bankTransactionList" => [],
                  "branchAddress" => null,
                  "cifNumber" => "[]",
                  "client" => null,
                  "creditCardNo" => null,
                  "creditLimit" => null,
                  "crnNo" => null,
                  "currentCashAdvance" => null,
                  "currentPurchaseCharges" => null,
                  "customer" => null,
                  "customerID" => null,
                  "customerPhoneNo" => "[]",
                  "dueDate" => null,
                  "email" => "",
                  "fromDate" => null,
                  "ifsCode" => "[]",
                  "isValidBankStatement" => true,
                  "jointHolderNameList" => [],
                  "lastPaymentReceived" => null,
                  "micrCode" => "[]",
                  "minAmountDue" => null,
                  "openingBalance" => null,
                  "pan" => "[]",
                  "pointsEarned" => null,
                  "prevBalance" => null,
                  "relationshipWithBank" => "",
                  "standardAccountHolderName" => null,
                  "toDate" => null,
                  "totalAmountDue" => null,
                  "uploadBankStatementCO" => null
                ],
                "cash_deposits" => $cash_deposits,
                "expenses" => [
                  [
                    "amount" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "merchantType" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null
                  ]
                ],
                "high_value_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTranscation" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "type" => null
                  ],

                ],
                "incomes" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "isSalary" => null,
                    "isSalaryCheck" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ]
                ],
                "internalTransactionList" => [],
                "investments" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionSubCategory" => null,
                    "type" => null
                  ]
                ],
                "minimum_balances" => $minimum_balance,
                "missingMonths" => [],
                "money_received_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "monthAndYear" => null,
                    "total" => null,
                    "transactionType" => null
                  ],
                ],
                "inward_cheque_return" => [
                  [
                    "date" => null,
                    "amount" => null,
                    "description" => null,
                    "balance" => null,
                    "category" => null,
                    "remark" => null,
                    "transactionType" => null,
                    "bank" => null,
                  ]
                ],
                "salary" => [
                  "average" => isset($bankAnalyser['average_balance']) ? $bankAnalyser['average_balance'] : null,
                  "monthlyDetails" => [
                    [
                      "monthYear" => null,
                      "total" => null,
                      "value" => null
                    ]
                  ],
                  "total" => isset($bankAnalyser['total_balance']) ? $bankAnalyser['total_balance'] : null,
                  "totalValue" => isset($bankAnalyser['total_deposit']) ? $bankAnalyser['total_deposit'] : null
                ]
              ];
              break;
            case 'Indian Bank':
              if (isset($bankAnalyser['withdrawal_transactions'])) {
                $atmwithdrawls = [];
                foreach ($bankAnalyser['withdrawal_transactions'] as $k => $response) {
                  $normilizeatmwithdrawls = [
                    'amount' => isset($response['Balance']) ? $response['Balance'] : null,
                    'bank' => null,
                    'date' => isset($response['Value Date']) ? $response['Value Date'] : null,
                    'description' => isset($response['Description']) ? $response['Description'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'total' => null,

                  ];
                  $atmwithdrawls[$k] = $normilizeatmwithdrawls;
                }
              } else {
                $atmwithdrawls = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $average_Monthlybalance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilizeaverageMonthlyBalance = [
                    'netAverageBalance' => isset($response['Balance Average']) ? $response['Balance Average'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'dayBalanceMap' => null,
                  ];
                  $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
                }
              } else {
                $average_Monthlybalance = [];
              }
              if (isset($bankAnalyser['deposit_transactions'])) {
                $cash_deposits = [];
                foreach ($bankAnalyser['deposit_transactions'] as $k => $response) {
                  $normilized_cashdeposits = [
                    "amount" => isset($response['Balance']) ? $response['Balance'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => isset($response['Value Date']) ? $response['Value Date'] : null,
                    "description" => isset($response['Description']) ? $response['Description'] : null,
                    "mode" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ];
                  $cash_deposits[$k] = $normilized_cashdeposits;
                }
              } else {
                $cash_deposits = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $minimum_balance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilized_minimum_balance = [
                    "amount" => isset($response['Balance Minimum']) ? $response['Balance Minimum'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionType" => null
                  ];
                  $minimum_balance[$k] = $normilized_minimum_balance;
                }

              } else {
                $minimum_balance = [];
              }
              $bankfinalanalyserResponse = [
                "atm_withdrawls" => $atmwithdrawls,
                "averageMonthlyBalance" => $average_Monthlybalance,
                "averageQuarterlyBalance" => [
                  [
                    "netAverageBalance" => null,
                    "monthAndYear" => null,
                  ],
                ],
                "bank_account" => [
                  "accountDetailsForAccountListPage" => null,
                  "accountHolder" => "[]",
                  "accountLimit" => null,
                  "accountNo" => null,
                  "accountType" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "address" => "[]",
                  "availableCashLimit" => null,
                  "availableCreditLimit" => null,
                  "bank" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "bankAccountUID" => null,
                  "bankAddress" => null,
                  "bankCredentialCO" => null,
                  "bankTransactionList" => [],
                  "branchAddress" => null,
                  "cifNumber" => "[]",
                  "client" => null,
                  "creditCardNo" => null,
                  "creditLimit" => null,
                  "crnNo" => null,
                  "currentCashAdvance" => null,
                  "currentPurchaseCharges" => null,
                  "customer" => null,
                  "customerID" => null,
                  "customerPhoneNo" => "[]",
                  "dueDate" => null,
                  "email" => "",
                  "fromDate" => null,
                  "ifsCode" => "[]",
                  "isValidBankStatement" => true,
                  "jointHolderNameList" => [],
                  "lastPaymentReceived" => null,
                  "micrCode" => "[]",
                  "minAmountDue" => null,
                  "openingBalance" => null,
                  "pan" => "[]",
                  "pointsEarned" => null,
                  "prevBalance" => null,
                  "relationshipWithBank" => "",
                  "standardAccountHolderName" => null,
                  "toDate" => null,
                  "totalAmountDue" => null,
                  "uploadBankStatementCO" => null
                ],
                "cash_deposits" => $cash_deposits,
                "expenses" => [
                  [
                    "amount" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "merchantType" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null
                  ]
                ],
                "high_value_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTranscation" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "type" => null
                  ],

                ],
                "incomes" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "isSalary" => null,
                    "isSalaryCheck" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ]
                ],
                "internalTransactionList" => [],
                "investments" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionSubCategory" => null,
                    "type" => null
                  ]
                ],
                "minimum_balances" => $minimum_balance,
                "missingMonths" => [],
                "money_received_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "monthAndYear" => null,
                    "total" => null,
                    "transactionType" => null
                  ],
                ],
                "inward_cheque_return" => [
                  [
                    "date" => null,
                    "amount" => null,
                    "description" => null,
                    "balance" => null,
                    "category" => null,
                    "remark" => null,
                    "transactionType" => null,
                    "bank" => null,
                  ]
                ],
                "salary" => [
                  "average" => isset($bankAnalyser['average_balance']) ? $bankAnalyser['average_balance'] : null,
                  "monthlyDetails" => [
                    [
                      "monthYear" => null,
                      "total" => null,
                      "value" => null
                    ]
                  ],
                  "total" => isset($bankAnalyser['total_balance']) ? $bankAnalyser['total_balance'] : null,
                  "totalValue" => isset($bankAnalyser['total_deposit']) ? $bankAnalyser['total_deposit'] : null
                ]
              ];
              break;
            case 'Hdfc Bank':
              if (isset($bankAnalyser['withdrawal_transactions'])) {
                $atmwithdrawls = [];
                foreach ($bankAnalyser['withdrawal_transactions'] as $k => $response) {
                  $normilizeatmwithdrawls = [
                    'amount' => isset($response['Closing Balance']) ? $response['Closing Balance'] : null,
                    'bank' => null,
                    'date' => isset($response['Date']) ? $response['Date'] : null,
                    'description' => isset($response['Narration']) ? $response['Narration'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'total' => null,

                  ];
                  $atmwithdrawls[$k] = $normilizeatmwithdrawls;
                }
              } else {
                $atmwithdrawls = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $average_Monthlybalance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilizeaverageMonthlyBalance = [
                    'netAverageBalance' => isset($response['Closing Balance Average']) ? $response['Closing Balance Average'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'dayBalanceMap' => null,
                  ];
                  $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
                }
              } else {
                $average_Monthlybalance = [];
              }
              if (isset($bankAnalyser['deposit_transactions'])) {
                $cash_deposits = [];
                foreach ($bankAnalyser['deposit_transactions'] as $k => $response) {
                  $normilized_cashdeposits = [
                    "amount" => isset($response['Closing Balance']) ? $response['Closing Balance'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => isset($response['Date']) ? $response['Date'] : null,
                    "description" => isset($response['Narration']) ? $response['Narration'] : null,
                    "mode" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ];
                  $cash_deposits[$k] = $normilized_cashdeposits;
                }
              } else {
                $cash_deposits = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $minimum_balance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilized_minimum_balance = [
                    "amount" => isset($response['Closing Balance Minimum']) ? $response['Closing Balance Minimum'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionType" => null
                  ];
                  $minimum_balance[$k] = $normilized_minimum_balance;
                }
              } else {
                $minimum_balance = [];
              }
              $bankfinalanalyserResponse = [
                "atm_withdrawls" => $atmwithdrawls,
                "averageMonthlyBalance" => $average_Monthlybalance,
                "averageQuarterlyBalance" => [
                  [
                    "netAverageBalance" => null,
                    "monthAndYear" => null,
                  ],
                ],
                "bank_account" => [
                  "accountDetailsForAccountListPage" => null,
                  "accountHolder" => "[]",
                  "accountLimit" => null,
                  "accountNo" => null,
                  "accountType" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "address" => "[]",
                  "availableCashLimit" => null,
                  "availableCreditLimit" => null,
                  "bank" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "bankAccountUID" => null,
                  "bankAddress" => null,
                  "bankCredentialCO" => null,
                  "bankTransactionList" => [],
                  "branchAddress" => null,
                  "cifNumber" => "[]",
                  "client" => null,
                  "creditCardNo" => null,
                  "creditLimit" => null,
                  "crnNo" => null,
                  "currentCashAdvance" => null,
                  "currentPurchaseCharges" => null,
                  "customer" => null,
                  "customerID" => null,
                  "customerPhoneNo" => "[]",
                  "dueDate" => null,
                  "email" => "",
                  "fromDate" => null,
                  "ifsCode" => "[]",
                  "isValidBankStatement" => true,
                  "jointHolderNameList" => [],
                  "lastPaymentReceived" => null,
                  "micrCode" => "[]",
                  "minAmountDue" => null,
                  "openingBalance" => null,
                  "pan" => "[]",
                  "pointsEarned" => null,
                  "prevBalance" => null,
                  "relationshipWithBank" => "",
                  "standardAccountHolderName" => null,
                  "toDate" => null,
                  "totalAmountDue" => null,
                  "uploadBankStatementCO" => null
                ],
                "cash_deposits" => $cash_deposits,
                "expenses" => [
                  [
                    "amount" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "merchantType" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null
                  ]
                ],
                "high_value_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTranscation" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "type" => null
                  ],

                ],
                "incomes" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "isSalary" => null,
                    "isSalaryCheck" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ]
                ],
                "internalTransactionList" => [],
                "investments" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionSubCategory" => null,
                    "type" => null
                  ]
                ],
                "minimum_balances" => $minimum_balance,
                "missingMonths" => [],
                "money_received_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "monthAndYear" => null,
                    "total" => null,
                    "transactionType" => null
                  ],
                ],
                "inward_cheque_return" => [
                  [
                    "date" => null,
                    "amount" => null,
                    "description" => null,
                    "balance" => null,
                    "category" => null,
                    "remark" => null,
                    "transactionType" => null,
                    "bank" => null,
                  ]
                ],
                "salary" => [
                  "average" => isset($bankAnalyser['average_balance']) ? $bankAnalyser['average_balance'] : null,
                  "monthlyDetails" => [
                    [
                      "monthYear" => null,
                      "total" => null,
                      "value" => null
                    ]
                  ],
                  "total" => isset($bankAnalyser['total_balance']) ? $bankAnalyser['total_balance'] : null,
                  "totalValue" => isset($bankAnalyser['total_deposit']) ? $bankAnalyser['total_deposit'] : null
                ]
              ];
              break;
            case 'Kotak Bank':
              if (isset($bankAnalyser['withdrawal_transactions'])) {
                $atmwithdrawls = [];
                foreach ($bankAnalyser['withdrawal_transactions'] as $k => $response) {
                  $normilizeatmwithdrawls = [
                    'amount' => isset($response['BALANCE']) ? $response['BALANCE'] : null,
                    'bank' => null,
                    'date' => isset($response['DATE']) ? $response['DATE'] : null,
                    'description' => isset($response['TRANSACTION DETAILS']) ? $response['TRANSACTION DETAILS'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'total' => null,

                  ];
                  $atmwithdrawls[$k] = $normilizeatmwithdrawls;
                }
              } else {
                $atmwithdrawls = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $average_Monthlybalance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilizeaverageMonthlyBalance = [
                    'netAverageBalance' => isset($response['BALANCE Average']) ? $response['BALANCE Average'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'dayBalanceMap' => null,
                  ];
                  $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
                }
              } else {
                $average_Monthlybalance = [];
              }
              if (isset($bankAnalyser['deposit_transactions'])) {
                $cash_deposits = [];
                foreach ($bankAnalyser['deposit_transactions'] as $k => $response) {
                  $normilized_cashdeposits = [
                    "amount" => isset($response['Balance']) ? $response['Balance'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => isset($response['DATE']) ? $response['DATE'] : null,
                    "description" => isset($response['TRANSACTION DETAILS']) ? $response['TRANSACTION DETAILS'] : null,
                    "mode" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ];
                  $cash_deposits[$k] = $normilized_cashdeposits;
                }

              } else {
                $cash_deposits = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $minimum_balance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilized_minimum_balance = [
                    "amount" => isset($response['BALANCE Minimum']) ? $response['BALANCE Minimum'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionType" => null
                  ];
                  $minimum_balance[$k] = $normilized_minimum_balance;
                }
              } else {
                $minimum_balance = [];
              }
              $bankfinalanalyserResponse = [
                "atm_withdrawls" => $atmwithdrawls,
                "averageMonthlyBalance" => $average_Monthlybalance,
                "averageQuarterlyBalance" => [
                  [
                    "netAverageBalance" => null,
                    "monthAndYear" => null,
                  ],
                ],
                "bank_account" => [
                  "accountDetailsForAccountListPage" => null,
                  "accountHolder" => "[]",
                  "accountLimit" => null,
                  "accountNo" => null,
                  "accountType" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "address" => "[]",
                  "availableCashLimit" => null,
                  "availableCreditLimit" => null,
                  "bank" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "bankAccountUID" => null,
                  "bankAddress" => null,
                  "bankCredentialCO" => null,
                  "bankTransactionList" => [],
                  "branchAddress" => null,
                  "cifNumber" => "[]",
                  "client" => null,
                  "creditCardNo" => null,
                  "creditLimit" => null,
                  "crnNo" => null,
                  "currentCashAdvance" => null,
                  "currentPurchaseCharges" => null,
                  "customer" => null,
                  "customerID" => null,
                  "customerPhoneNo" => "[]",
                  "dueDate" => null,
                  "email" => "",
                  "fromDate" => null,
                  "ifsCode" => "[]",
                  "isValidBankStatement" => true,
                  "jointHolderNameList" => [],
                  "lastPaymentReceived" => null,
                  "micrCode" => "[]",
                  "minAmountDue" => null,
                  "openingBalance" => null,
                  "pan" => "[]",
                  "pointsEarned" => null,
                  "prevBalance" => null,
                  "relationshipWithBank" => "",
                  "standardAccountHolderName" => null,
                  "toDate" => null,
                  "totalAmountDue" => null,
                  "uploadBankStatementCO" => null
                ],
                "cash_deposits" => $cash_deposits,
                "expenses" => [
                  [
                    "amount" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "merchantType" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null
                  ]
                ],
                "high_value_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTranscation" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "type" => null
                  ],

                ],
                "incomes" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "isSalary" => null,
                    "isSalaryCheck" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ]
                ],
                "internalTransactionList" => [],
                "investments" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionSubCategory" => null,
                    "type" => null
                  ]
                ],
                "minimum_balances" => $minimum_balance,
                "missingMonths" => [],
                "money_received_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "monthAndYear" => null,
                    "total" => null,
                    "transactionType" => null
                  ],
                ],
                "inward_cheque_return" => [
                  [
                    "date" => null,
                    "amount" => null,
                    "description" => null,
                    "balance" => null,
                    "category" => null,
                    "remark" => null,
                    "transactionType" => null,
                    "bank" => null,
                  ]
                ],
                "salary" => [
                  "average" => isset($bankAnalyser['average_balance']) ? $bankAnalyser['average_balance'] : null,
                  "monthlyDetails" => [
                    [
                      "monthYear" => null,
                      "total" => null,
                      "value" => null
                    ]
                  ],
                  "total" => isset($bankAnalyser['total_balance']) ? $bankAnalyser['total_balance'] : null,
                  "totalValue" => isset($bankAnalyser['total_deposit']) ? $bankAnalyser['total_deposit'] : null
                ]
              ];
              break;
            case 'Bank of India':
              if (isset($bankAnalyser['withdrawal_transactions'])) {
                $atmwithdrawls = [];
                foreach ($bankAnalyser['withdrawal_transactions'] as $k => $response) {
                  $normilizeatmwithdrawls = [
                    'amount' => isset($response['Balance (in Rs.)']) ? $response['Balance (in Rs.)'] : null,
                    'bank' => null,
                    'date' => isset($response['Txn Date']) ? $response['Txn Date'] : null,
                    'description' => isset($response['Description']) ? $response['Description'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'total' => null,

                  ];
                  $atmwithdrawls[$k] = $normilizeatmwithdrawls;
                }
              } else {
                $atmwithdrawls = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $average_Monthlybalance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilizeaverageMonthlyBalance = [
                    'netAverageBalance' => isset($response['Balance (in Rs.) Average']) ? $response['Balance (in Rs.) Average'] : null,
                    'monthAndYear' => isset($response['YearMonth']) ? $response['YearMonth'] : null,
                    'dayBalanceMap' => null,
                  ];
                  $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
                }
              } else {
                $average_Monthlybalance = [];
              }
              if (isset($bankAnalyser['deposit_transactions'])) {
                $cash_deposits = [];
                foreach ($bankAnalyser['deposit_transactions'] as $k => $response) {
                  $normilized_cashdeposits = [
                    "amount" => isset($response['Balance (in Rs.)']) ? $response['Balance (in Rs.)'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => isset($response['Txn Date']) ? $response['Txn Date'] : null,
                    "description" => isset($response['Description']) ? $response['Description'] : null,
                    "mode" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ];
                  $cash_deposits[$k] = $normilized_cashdeposits;
                }

              } else {
                $cash_deposits = [];
              }
              if (isset($bankAnalyser['monthwise_stats'])) {
                $minimum_balance = [];
                foreach ($bankAnalyser['monthwise_stats'] as $k => $response) {
                  $normilized_minimum_balance = [
                    "amount" => isset($response['Balance (in Rs.) Maximum']) ? $response['Balance (in Rs.) Maximum'] : null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionType" => null
                  ];
                  $minimum_balance[$k] = $normilized_minimum_balance;
                }
              } else {
                $minimum_balance = [];
              }
              $bankfinalanalyserResponse = [
                "atm_withdrawls" => $atmwithdrawls,
                "averageMonthlyBalance" => $average_Monthlybalance,
                "averageQuarterlyBalance" => [
                  [
                    "netAverageBalance" => null,
                    "monthAndYear" => null,
                  ],
                ],
                "bank_account" => [
                  "accountDetailsForAccountListPage" => null,
                  "accountHolder" => "[]",
                  "accountLimit" => null,
                  "accountNo" => null,
                  "accountType" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "address" => "[]",
                  "availableCashLimit" => null,
                  "availableCreditLimit" => null,
                  "bank" => [
                    "enumType" => null,
                    "name" => null
                  ],
                  "bankAccountUID" => null,
                  "bankAddress" => null,
                  "bankCredentialCO" => null,
                  "bankTransactionList" => [],
                  "branchAddress" => null,
                  "cifNumber" => "[]",
                  "client" => null,
                  "creditCardNo" => null,
                  "creditLimit" => null,
                  "crnNo" => null,
                  "currentCashAdvance" => null,
                  "currentPurchaseCharges" => null,
                  "customer" => null,
                  "customerID" => null,
                  "customerPhoneNo" => "[]",
                  "dueDate" => null,
                  "email" => "",
                  "fromDate" => null,
                  "ifsCode" => "[]",
                  "isValidBankStatement" => true,
                  "jointHolderNameList" => [],
                  "lastPaymentReceived" => null,
                  "micrCode" => "[]",
                  "minAmountDue" => null,
                  "openingBalance" => null,
                  "pan" => "[]",
                  "pointsEarned" => null,
                  "prevBalance" => null,
                  "relationshipWithBank" => "",
                  "standardAccountHolderName" => null,
                  "toDate" => null,
                  "totalAmountDue" => null,
                  "uploadBankStatementCO" => null
                ],
                "cash_deposits" => $cash_deposits,
                "expenses" => [
                  [
                    "amount" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "merchantType" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null
                  ]
                ],
                "high_value_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTranscation" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "type" => null
                  ],

                ],
                "incomes" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "isSalary" => null,
                    "isSalaryCheck" => null,
                    "mode" => null,
                    "monthAndYear" => null,
                    "partyName" => null,
                    "purpose" => null,
                    "total" => null,
                    "transactionType" => null
                  ]
                ],
                "internalTransactionList" => [],
                "investments" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "transactionSubCategory" => null,
                    "type" => null
                  ]
                ],
                "minimum_balances" => $minimum_balance,
                "missingMonths" => [],
                "money_received_transactions" => [
                  [
                    "amount" => null,
                    "balanceAfterTransaction" => null,
                    "bank" => null,
                    "category" => null,
                    "date" => null,
                    "description" => null,
                    "monthAndYear" => null,
                    "total" => null,
                    "transactionType" => null
                  ],
                ],
                "inward_cheque_return" => [
                  [
                    "date" => null,
                    "amount" => null,
                    "description" => null,
                    "balance" => null,
                    "category" => null,
                    "remark" => null,
                    "transactionType" => null,
                    "bank" => null,
                  ]
                ],
                "salary" => [
                  "average" => isset($bankAnalyser['average_balance']) ? $bankAnalyser['average_balance'] : null,
                  "monthlyDetails" => [
                    [
                      "monthYear" => null,
                      "total" => null,
                      "value" => null
                    ]
                  ],
                  "total" => isset($bankAnalyser['total_balance']) ? $bankAnalyser['total_balance'] : null,
                  "totalValue" => isset($bankAnalyser['total_deposit']) ? $bankAnalyser['total_deposit'] : null
                ]
              ];
              break;
            default:
              return response()->json([
                'statusCode' => 102,
                'message' => "Please enter valid bank name."
              ]);
          }
          return response()->json(['statusCode' => 200, 'response' => $bankfinalanalyserResponse]);
        } elseif (isset($bank_analyser['Data']['error']) && $bank_analyser['Data']['error'] == "'Withdrawal'" || $bank_analyser['Data']['error'] == "'Deposit'" || $bank_analyser['Data']['error'] == "'Balance'") {
          $statusCode = 102;
          $errorMessage = "something is wrong.";
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
          }
          return response()->json(['statusCode' => 102, 'message' => $errorMessage]);
        } elseif (isset($http_code) && $http_code == 500) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
            }
          }
          return response()->json(['statusCode' => 102, 'message' => "Invalid bank statement and bank name. Please enter valid bank statement and  bank name."]);
        } else {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 500);
            }
          }
          return response()->json(['statusCode' => 500, 'message' => "Internal Server Error.Please contact techsupport@docboyz.in. for more details."]);
        }
      } else {
        return response()->json(['statusCode' => 500, 'message' => 'Please Recharage your plan.']);
      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }
  public function bankReader(Request $request)
  {

    $statusCode = null;
    $api_id = null;
    $bankStatement = [];
    if (empty($request->hasFile('bankStmt'))) {
      return response()->json(['message' => 'file is required', 'statusCode' => '404']);
    }
    if (empty($request->BankName)) {
      return response()->json(['message' => 'bank name is required', 'statusCode' => '404']);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }
    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }

    $user = User::where('access_token', $request->header('AccessToken'))->first();

    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();


    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://13.127.202.182:8080/reader',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => [
            'pdf' => new \CURLFILE($_FILES['bankStmt']['tmp_name'], $_FILES['bankStmt']['type'], $_FILES['bankStmt']['name']),
            'bankName' => $request->BankName,
            'accountType' => $request->accountType,
            'password' => $request->password
          ],
        ]);
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $bankstatment = json_decode($response, true);
        if (isset($bankstatment['statuscode']) && $bankstatment['statuscode'] == 200) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
          }
          $bankStatement = isset($bankstatment['Data']) ? $bankstatment['Data'] : null;
          $bankName = $request->BankName;
          $bankfinalStatement = null;
          switch ($bankName) {
            case 'Indian Bank':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['CR']) && $response['CR'] !== '' ? $response['CR'] : (isset($response['DR']) && $response['DR'] !== '' ? $response['DR'] : null),
                  'balanceAfterTransaction' => isset($response['Balance']) ? $response['Balance'] : null,
                  'bank' => 'Indian Bank',
                  'batchID' => isset($response['category']) ? $response['category'] : 'OPENING_BALANCE',  // Default to 'OPENING_BALANCE'
                  'category' => isset($response['category']) ? $response['category'] : null,
                  'dateTime' => isset($response['Post Date']) ? $response['Post Date'] : null,
                  'description' => isset($response['Description']) ? $response['Description'] : null,
                  'remark' => isset($response['Remitter Branch']) ? $response['Remitter Branch'] : '',
                  'transactionId' => $response['Chq./Ref.No.'] ?? null,
                  'transactionNumber' => '',
                  'type' => isset($response['CR']) && $response['CR'] !== '' ? 'credit' : (isset($response['DR']) && $response['DR'] !== '' ? 'debit' : ''),
                  'valueDate' => isset($response['Value Date']) ? $response['Value Date'] : '',
                ];
                $statements[$k] = $normalizedResponse;
              }
              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];

              break;
            case 'Kotak Bank':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['Amount']) ? $response['Amount'] : null,
                  'balanceAfterTransaction' => isset($response['Balance']) ? $response['Balance'] : null,
                  'bank' => 'Kotak Bank',
                  'batchID' => null,
                  'category' => null,
                  'dateTime' => isset($response['Date']) ? $response['Date'] : null,
                  'description' => isset($response['Description']) ? $response['Description'] : null,
                  'remark' => '',
                  'transactionId' => isset($response['SI. No.']) ? $response['SI. No.'] : null,
                  'transactionNumber' => isset($response['Chq / Ref number']) ? $response['Chq / Ref number'] : '',
                  'type' => isset($response['Dr / Cr']) && $response['Dr / Cr'] === 'DR' ? 'DEBIT' : (isset($response['Dr / Cr']) && $response['Dr / Cr'] === 'CR' ? 'CREDIT' : ''),
                  'valueDate' => null
                ];
                $statements[$k] = $normalizedResponse;
              }
              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];

              break;
            case 'Hdfc Bank':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['Deposit Amt.']) && $response['Deposit Amt.'] !== '' ? $response['Deposit Amt.'] : (isset($response['Withdrawal Amt.']) && $response['Withdrawal Amt.'] !== '' ? $response['Withdrawal Amt.'] : null),
                  'balanceAfterTransaction' => isset($response['Closing Balance']) ? $response['Closing Balance'] : null,
                  'bank' => 'Hdfc Bank',
                  'batchID' => null,
                  'category' => 'OPENING_BALANCE',
                  'dateTime' => isset($response['Date']) ? $response['Date'] : null,
                  'description' => isset($response['Narration']) ? $response['Narration'] : null,
                  'remark' => '',
                  'transactionId' => isset($response['Chq./Ref.No.']) ? $response['Chq./Ref.No.'] : null,
                  'transactionNumber' => '',
                  'type' => isset($response['Deposit Amt.']) && $response['Deposit Amt.'] !== '' ? 'CREDIT' : (isset($response['Withdrawal Amt.']) && $response['Withdrawal Amt.'] !== '' ? 'DEBIT' : ''),
                  'valueDate' => isset($response['Value Dt']) ? $response['Value Dt'] : '',
                ];
                $statements[$k] = $normalizedResponse;
              }

              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];
              break;
            case 'ICICI Bank':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['WITHDRAWALS']) && $response['WITHDRAWALS'] !== '' ? $response['WITHDRAWALS'] : (isset($response['DEPOSITS']) && $response['DEPOSITS'] !== '' ? $response['DEPOSITS'] : null),
                  'balanceAfterTransaction' => isset($response['BALANCE']) ? $response['BALANCE'] : null,
                  'bank' => 'ICICI BANK',
                  'batchID' => null,
                  'category' => isset($response['PARTICULARS']) ? 'TRANSACTION' : null,
                  'dateTime' => isset($response['DATE']) ? $response['DATE'] : null,
                  'description' => isset($response['PARTICULARS']) ? $response['PARTICULARS'] : null,
                  'remark' => '',
                  'transactionId' => null,
                  'transactionNumber' => '',
                  'type' => isset($response['WITHDRAWALS']) && $response['WITHDRAWALS'] !== '' ? 'DEBIT' : (isset($response['DEPOSITS']) && $response['DEPOSITS'] !== '' ? 'CREDIT' : ''),
                  'valueDate' => ''
                ];
                $statements[$k] = $normalizedResponse;
              }

              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];
              break;
            case 'Bank of Baroda':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['WITHDRAWAL (DR)']) && $response['WITHDRAWAL (DR)'] !== '' ? $response['WITHDRAWAL (DR)'] : (isset($response['DEPOSIT(CR)']) && $response['DEPOSIT(CR)'] !== '' ? $response['DEPOSIT(CR)'] : null),
                  'balanceAfterTransaction' => isset($response['BALANCE(INR)']) ? $response['BALANCE(INR)'] : null,
                  'bank' => 'Bank Of Baroda',
                  'batchID' => null,
                  'category' => null,
                  'dateTime' => isset($response['DATE']) ? $response['DATE'] : null,
                  'description' => isset($response['NARRATION']) ? $response['NARRATION'] : null,
                  'remark' => '',
                  'transactionId' => null,
                  'transactionNumber' => isset($response['CHQ.NO.']) ? $response['CHQ.NO.'] : null,
                  'type' => isset($response['WITHDRAWAL (DR)']) && $response['WITHDRAWAL (DR)'] !== '' ? 'DEBIT' : (isset($response['DEPOSIT(CR)']) && $response['DEPOSIT(CR)'] !== '' ? 'CREDIT' : ''),
                  'valueDate' => ''
                ];
                $statements[$k] = $normalizedResponse;
              }

              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];
              break;
            case 'Bank of India':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['Withdrawal (in Rs.)']) && $response['Withdrawal (in Rs.)'] !== '' ? $response['Withdrawal (in Rs.)'] : (isset($response['Deposits (in Rs.)']) && $response['Deposits (in Rs.)'] !== '' ? $response['Deposits (in Rs.)'] : null),
                  'balanceAfterTransaction' => isset($response['Balance (in Rs.)']) ? $response['Balance (in Rs.)'] : null,
                  'bank' => 'BOI',
                  'batchID' => null,
                  'category' => null,
                  'dateTime' => isset($response['Txn Date']) ? $response['Txn Date'] : null,
                  'description' => isset($response['Description']) ? $response['Description'] : null,
                  'remark' => '',
                  'transactionId' => isset($response['SI No']) ? $response['SI No'] : null,
                  'transactionNumber' => isset($response['Cheque No']) ? $response['Cheque No'] : '',
                  'type' => isset($response['Withdrawal (in Rs.)']) && $response['Withdrawal (in Rs.)'] !== '' ? 'DEBIT' : (isset($response['Deposits (in Rs.)']) && $response['Deposits (in Rs.)'] !== '' ? 'CREDIT' : ''),
                  'valueDate' => ''
                ];
                $statements[$k] = $normalizedResponse;

              }

              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];
              break;
            case 'Yes Bank':
              $statements = [];
              foreach ($bankStatement as $k => $response) {
                $normalizedResponse = [
                  'amount' => isset($response['Debit Amount']) && $response['Debit Amount'] !== '0.00' ? $response['Debit Amount'] : (isset($response['Credit Amount']) && $response['Credit Amount'] !== '0.00' ? $response['Credit Amount'] : null),
                  'balanceAfterTransaction' => isset($response['Running Balance']) ? $response['Running Balance'] : null,
                  'bank' => 'Yes Bank',
                  'batchID' => null,
                  'category' => null,
                  'dateTime' => isset($response['Transaction Date']) ? $response['Transaction Date'] : null,
                  'description' => isset($response['Transaction Description']) ? $response['Transaction Description'] : null,
                  'remark' => '',
                  'transactionId' => isset($response['Reference No']) ? $response['Reference No'] : null,
                  'transactionNumber' => null,
                  'type' => isset($response['Debit Amount']) && $response['Debit Amount'] !== '0.00' ? 'DEBIT' : (isset($response['Credit Amount']) && $response['Credit Amount'] !== '0.00' ? 'CREDIT' : ''),
                  'valueDate' => isset($response['Value Date']) ? $response['Value Date'] : null
                ];
                $statements[$k] = $normalizedResponse;
              }

              $bankfinalStatement = [
                "bank_account" => [
                  "accountName" => null,
                  "jointHolderName" => null,
                  "accountNumber" => null,
                  "bankName" => null,
                  "accountType" => null,
                  "IFSC" => null,
                  "statementUpload" => null,
                  "mobile" => null,
                  "email" => null,
                  "pan" => null,
                  "currentBalance" => null,
                  "address" => null,
                  "relationshipWithBank" => null
                ],
                "missingMonths" => null,
                "sanctionedAmount" => null,
                "monthWiseAnlaysis" => [
                  "monthlyAvgBal" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minBalance" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "cashWithdrawals" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "chqIssues" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonCashCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "credits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "outwBounce" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "penaltyCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestPaid" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "overdrawnPeriod" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "ECS/NACH" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "peakUtilization" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "averageUtilizationOD_CC" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetDebit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "totalNetCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestReceived" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfWithdraw" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "selfDeposit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "neftReturn" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "interestServiceDelay" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanRepayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "emiMoratorium" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardChequeBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "inwardBounce%" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCreditGap" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "loanCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditCardPayment" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "debitInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "creditInternalTransaction" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "minCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "maxCredits" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "salary" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "nonSalaryCredit" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "expense" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "bankCharges" => [
                    "average" => null,
                    "monthlyDetails" => null,
                    "total" => null,
                    "totalValue" => null
                  ],
                  "digitalTransfer" => [
                    "digitalTransferDebit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ],
                    "digitalTransferCredit" => [
                      "average" => null,
                      "monthlyDetails" => null,
                      "total" => null,
                      "totalValue" => null
                    ]
                  ]
                ],
                "openingAndClosingBalance" => null,
                "incomePerMonth" => null,
                "incomes" => null,
                "expensePerMonth" => null,
                "creditCardPaymentPerMonth" => null,
                "eodBalancePerMonth" => null,
                "message" => null,
                "loanRepaymentInstances" => null,
                "bounceTransactions" => [
                  "inwardChequeOrEcsBounceMonthwise" => null,
                  "outwardChequeBounceMonthwise" => null
                ],
                "dailyEODBalance" => null,
                "topFiveFundsTransfer" => null,
                "topFiveFundsReceived" => null,
                "transactions" => $statements,
                "FraudAnalytics" => [
                  "fraudAnalyticStatus" => null,
                  "result" => null,
                  "summary" => null,
                  "status" => null
                ]
              ];
              break;
            default:
              return response()->json(['statusCode' => 102, 'message' => "Please enter valid bank name."]);
          }

          return response()->json(['statusCode' => 200, 'response' => $bankfinalStatement]);
        } elseif (isset($bankstatment['error']) && $bankstatment['error'] == 'Invalid file type, must be a PDF') {
          $statusCode = 102;
          $errorMessage = 'Invalid file type, must be a PDF';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
          }
          return response()->json(['statusCode' => 102, 'message' => $errorMessage]);
        } elseif (isset($http_code) && $http_code == 500) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
            }
          }
          return response()->json(['statusCode' => 102, 'message' => "Invalid bank statement and bank name. Please enter valid bank statement and  bank name."]);
        } else {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 500);
            }
          }
          return response()->json(['statusCode' => 500, 'message' => "Internal Server Error.Please contact techsupport@docboyz.in. for more details."]);
        }
      } else {
        return response()->json(['statusCode' => 500, 'message' => 'Please Recharge your wallet.']);
      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }
  public function extractPanCard(Request $request)
  {
    $statusCode = null;
    $pan_cards = null;
    $api_id = null;
    if (empty($request->hasFile('file'))) {
      return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }

    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }
    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'pancardextracttext')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://pyn.regtechapi.in/extract-pan-text',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $pancard = json_decode($response, true);
        if (isset($pancard['detected_text'])) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
            $paninfo = DB::table('pancard_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'description' => isset($pancard['detected_text']) ? $pancard['detected_text'] : null,
              'date_of_birth' => isset($pancard['extracted_info']['date_of_birth']) ? $pancard['extracted_info']['date_of_birth'] : null,
              'pan_number' => isset($pancard['extracted_info']['pan_number']) ? $pancard['extracted_info']['pan_number'] : null,
              'status_code' => 200,
              'message_code' => 'success',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 200, 'pancard' => $pancard]);
        } elseif (isset($pancard['error']) && $pancard['error'] == 'Invalid file type, must be an image') {
          $statusCode = 102;
          $errorMessage = 'Invalid file type, must be an image';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
            $paninfo = DB::table('pancard_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => 102,
              'message_code' => 'failed',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }

          return response()->json(['status_code' => 102, 'message' => $errorMessage]);
        } elseif (isset($pancard['error']) && $pancard['error'] == 'No file provided') {
          $statusCode = 404;
          $errorMessage = 'No image file provided';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
            }
            $paninfo = DB::table('pancard_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => 102,
              'message_code' => 'failed',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        } else {
          $statusCode = 500;
          $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            $paninfo = DB::table('pancard_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => 500,
              'message_code' => 'failed',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }

          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        }
      } else {
        return response()->json(['statusCode' => 500, 'message' => 'Please recharge your wallet amount.']);
      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }
  public function extractVoterId(Request $request)
  {
    $statusCode = null;
    $voter_id = null;
    $api_id = null;
    if (empty($request->hasFile('file'))) {
      return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
    }
    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }
    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }
    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'voterextracttext')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://pyn.regtechapi.in/extract-voter-id-text',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $voterid = json_decode($response, true);
        if (isset($voterid['detected_text'])) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
            $voter_id = DB::table('voter_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'name' => isset($voterid['extracted_info']['name']) ? $voterid['extracted_info']['name'] : null,
              'epic_no' => isset($voterid['extracted_info']['voter_id']) ? $voterid['extracted_info']['voter_id'] : null,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 200, 'voterid' => $voterid]);
        } elseif (isset($voterid['error']) && $voterid['error'] == 'Invalid file type, must be an image') {
          $statusCode = 102;
          $errorMessage = 'Invalid file type, must be an voter image';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
            $voter_id = DB::table('voter_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 102, 'message' => $errorMessage]);
        } elseif (isset($voterid['error']) && $voterid['error'] == 'No file provided') {
          $statusCode = 404;
          $errorMessage = 'No image file provided';
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        } else {
          $statusCode = 500;
          $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            $voter_id = DB::table('voter_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        }
      } else {
        return response()->json(['statusCode' => 103, 'message' => 'Please reacharge your wallet amount.']);
      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }

  public function aadharCardExtract(Request $request)
  {
    $statusCode = null;
    $aadhar_card = null;
    $api_id = null;
    if (empty($request->hasFile('file'))) {
      return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }

    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }
    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'aadharextracttext')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();

    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://pyn.regtechapi.in/extract-aadhar-text',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $aadhar_card = json_decode($response, true);
        if (isset($aadhar_card['detected_text'])) {
          $aadharcard_response = null;
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
            $aadharcard = DB::table('extract_aadhar')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'aadhar_no' => isset($aadhar_card['extracted_info']['aadhar_number'][0]) ? $aadhar_card['extracted_info']['aadhar_number'][0] : null,
              'date_of_birth' => isset($aadhar_card['extracted_info']['date_of_birth'][0]) ? $aadhar_card['extracted_info']['date_of_birth'][0] : null,
              'name' => isset($aadhar_card['extracted_info']['name'][0]) ? $aadhar_card['extracted_info']['name'][0] : null,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          $aadharcard_response['detected_text'] = isset($aadhar_card['detected_text']) ? $aadhar_card['detected_text'] : null;
          $aadharcard_response['extracted_info']['date_of_birth'] = isset($aadhar_card['extracted_info']['date_of_birth'][0]) ? $aadhar_card['extracted_info']['date_of_birth'][0] : null;
          $aadharcard_response['extracted_info']['aadhar_number'] = isset($aadhar_card['extracted_info']['aadhar_number'][0]) ? $aadhar_card['extracted_info']['aadhar_number'][0] : null;
          $aadharcard_response['extracted_info']['name'] = isset($aadhar_card['extracted_info']['name'][0]) ? $aadhar_card['extracted_info']['name'][0] : null;
          return response()->json(['status_code' => 200, 'aadharcard' => $aadharcard_response]);
        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == 'Invalid file type, must be an image') {
          $statusCode = 102;
          $errorMessage = 'Invalid file type, must be an aadhar card image.';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
            $aadharcard = DB::table('extract_aadhar')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 102, 'message' => $errorMessage]);
        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == 'No file provided') {
          $statusCode = 404;
          $errorMessage = 'No image file provided';
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        } else {
          $statusCode = 500;
          $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            $aadharcard = DB::table('extract_aadhar')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        }
      } else {
        return response()->json(['statusCode' => 103, 'message' => 'Please reacharge your wallet amount.']);

      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }
  public function drivingLicenseExtract(Request $request)
  {
    $statusCode = null;
    $drivinglicense = null;
    $api_id = null;
    if (empty($request->hasFile('file'))) {
      return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }

    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }
    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'licenseextracttext')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();

    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://pyn.regtechapi.in/extract-dl-text',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $drivinglicense = json_decode($response, true);
        if (isset($drivinglicense['detected_text'])) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
            $driving_license = DB::table('driving_license_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'license_number' => isset($drivinglicense['extracted_info']['dl_no']) ? $drivinglicense['extracted_info']['dl_no'] : null,
              'dob' => isset($drivinglicense['extracted_info']['birth_date']) ? $drivinglicense['extracted_info']['birth_date'] : null,
              'valid_till' => isset($drivinglicense['extracted_info']['Valid Till']) ? $drivinglicense['extracted_info']['Valid Till'] : null,
              'name' => isset($drivinglicense['extracted_info']['name']) ? $drivinglicense['extracted_info']['name'] : null,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 200, 'driving_license' => $drivinglicense]);
        } elseif (isset($drivinglicense['error']) && $drivinglicense['error'] == 'Invalid file type, must be an image') {
          $statusCode = 102;
          $errorMessage = 'Invalid file type, must be an driving license image.';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
            $driving_license = DB::table('driving_license_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 102, 'message' => $errorMessage]);
        } elseif (isset($drivinglicense['error']) && $drivinglicense['error'] == 'No file provided') {
          $statusCode = 404;
          $errorMessage = 'No image file provided';
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        } else {
          $statusCode = 500;
          $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            $driving_license = DB::table('driving_license_extract')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
        }
      } else {
        return response()->json(['statusCode' => 103, 'message' => 'Please reacharge your wallet amount.']);

      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }
  public function predictppl(Request $request)
  {
    $statusCode = null;
    $predictppl_details = null;
    $api_id = null;
    if (empty($request->hasFile('file'))) {
      return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
    }

    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
    }
    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'predictppl')->first();
      if ($apiamster) {
        $api_id = $apiamster->id;
      }
    }
    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
      ->where('api_id', $api_id)
      ->orderBy('id', 'desc')
      ->first();

    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "role_postpaid") {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://pyn.regtechapi.in/predictppl',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
        ]);
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $predictppl_details = json_decode($response, true);

        if (isset($predictppl_details) && isset($http_code) && $http_code == 200) {
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
            }
            DB::table('loan_predict')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'predict_details' => isset($predictppl_details) ? json_encode($predictppl_details, true) : null,
              'status_code' => 200,
              'message' => "success",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);

          }
          $filename = time() . '_predict-rep.csv';
          $publicPath = public_path("predict-reports/{$filename}");
          $file = fopen($publicPath, 'w');
          if (!empty($predictppl_details)) {
            $headers = array_keys($predictppl_details[0]);
            fputcsv($file, $headers);
          }
          foreach ($predictppl_details as $row) {
            fputcsv($file, $row);
          }

          fclose($file);
          header('Content-Type: text/csv');
          header('Content-Disposition: attachment;filename="' . $publicPath . '"');
          return response()->json(['statusCode' => 200, 'data' => $predictppl_details]);
        } elseif (isset($http_code) && $http_code == 400) {
          $statusCode = 102;
          $errorMessage = 'Invalid file.Please upload valid file.';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
            }
            DB::table('loan_predict')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => 102,
              'message' => "failed",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['statusCode' => 102, 'message' => $errorMessage]);
        } elseif (isset($http_code) && $http_code == 500) {
          $statusCode = 500;
          $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            DB::table('loan_predict')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => 500,
              'message' => "failed",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
        } else {
          $statusCode = $http_code;
          $errorMessage = 'Error.Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1) {
            if ($apiamster) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
            }
            DB::table('loan_predict')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'status_code' => $statusCode,
              'message' => "failed",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
        }
      } else {
        return response()->json(['statusCode' => 103, 'message' => 'Please recharge your wallet amount.']);

      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }
  }


  //create new function 

  public function verifyToken($access_token)
  {
    $user = User::where('access_token', $access_token)->count();
    if ($user > 0) {
      return true;
    } else {
      false;
    }
  }



  // demo
  public function update_balance($user_id, $amount)
  {
    $userwallet = User::where('id', $user_id)->first();
    $userwallet->wallet_amount = $userwallet->wallet_amount - $amount;
    $userwallet->save();
  }

  public function transac_id()
  {
    $str_result = '1234567890';
    $transaction_gen = substr(str_shuffle($str_result), 0, 12);

    $transaction = Transaction::where('transaction_id', $transaction_gen)->first();
    if ($transaction) {
      $transaction_gen = substr(str_shuffle($str_result), 0, 12);
    }

    return $transaction_gen;
  }

  public function update_transac($user_id, $api_id, $amount, $remark, $statusCode)
  {
    $user = User::where('id', $user_id)->first();
    $transaction = new Transaction;
    $transaction->transaction_id = $this->transac_id();
    $transaction->user_id = $user_id;
    $transaction->api_id = $api_id; //work
    $transaction->type_creditdebit = 'Debit';
    $transaction->hit_year_month = date('Y-m');
    $transaction->scheme_price = $amount;  //work
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




  public function HitCount($user_id, $api_id, $remark, $statusCode)
  {
    $cnt200 = 0;
    $cnt400 = 0;
    $cnt101 = 0;
    $payableHits = 0;
    $scheme_price = 0;
    $total_amount = 0;
    $updateHitCount = UserSchemeMaster::where('user_id', $user_id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    $payment_slab = explode(',', $updateHitCount->payment_slab);

    $scheme_prices = explode(',', $updateHitCount->scheme_price);

    // $transactions = Transaction::where('user_id', $user_id)->where('api_id',$api_id)->where('hit_year_month', date('Y-m'))->get();
    $transactions = Transaction::where('user_id', $user_id)->where('api_id', $api_id)->where('hit_year_month', date('Y-m'))->count();
    

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

        if ($i == (count($payment_slab) - 1)) {
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
      'total_transaction_amount_per_api' => $total_amount
    ]);

    $addHitCount = new HitCountMaster;
    $addHitCount->user_id = $user_id;
    $addHitCount->api_id = $api_id;
    $addHitCount->scheme_price = $scheme_price;
    $addHitCount->hit_year_month = date('Y-m');
    $addHitCount->hit_count = 1;
    $addHitCount->save();
    $this->update_balance($user_id, $scheme_price);
    $this->update_transac($user_id, $api_id, $scheme_price, $remark, $statusCode);
  }


  public function newPanCard(Request $request)
  {
    $api_id = null;
    $apiamster = null;
    $statusCode = null;

    $panNumber = $request->pan_no;
    if (empty($panNumber)) {
      return response()->json(array(['message' => 'Pancard number is required', 'statusCode' => '404']));
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json(array(['message' => 'Header Access Token is required', 'statusCode' => '404']));
    }

    $verifyAccessToken = $this->verifyToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json(array(['message' => 'Wrong access token', 'statusCode' => '403']));
    }

    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apimaster = ApiMaster::where('api_slug', 'pancard')->first();
      if ($apimaster)
        $api_id = $apimaster->id;

    }

    $client = new Client();
    $groupId = rand(100, 10000000000);
    $checkId = rand(100, 10000000000);

    $headers = [
      'Accept' => 'application/json',
      'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq'
    ];

    $body = [
      'panNumber' => $request->pan_no,
      'groupId' => $groupId,
      'checkId' => $checkId
    ];


    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == 'role_postpaid') {
        try {
          $response = $client->post('https://api.kyckart.com/api/panCard/panDetailedContactV4', [
            'headers' => $headers,
            'json' => $body,
          ]);
          $pancard_details = json_decode($response->getBody(), true);

          $pancard['data']['client_id'] = null;
          $pancard['data']['pan_number'] = isset($pancard_details['response']['pan']) ? $pancard_details['response']['pan'] : null;
          $pancard['data']['full_name'] = isset($pancard_details['response']['firstName']) ? $pancard_details['response']['firstName'] . ' ' . $pancard_details['response']['middleName'] . ' ' . $pancard_details['response']['lastName'] : null;
          $pancard['data']['category'] = isset($pancard_details['response']['typeOfHolder']) ? $pancard_details['response']['typeOfHolder'] : null;

          if ($user->role_id == 1) {

            if ($apimaster) {

              $this->HitCount($user->id, $api_id, 'Transaction Successful', 200);
              //  $panvalidation = DB::table('pancard_varification')->insert([
              //      "user_id"=> $user->id,
              //      "api_id"=> $api_id,
              //      "pancard_id"=> isset($pancard['data']['pan_number'])?$pancard['data']['pan_number']:null,
              //      "name"=> isset($pancard['data']['full_name'])?$pancard['data']['full_name']:null,
              //      // "name"=> $pancard['response']['registered_name'],
              //      'groupId'=>isset($groupId)?$groupId:null,
              //      'checkId'=>isset($checkId)?$checkId:null,
              //      'vender_status_code'=>isset($pancard_details['status']['statusCode'])?$pancard_details['status']['statusCode']:null,
              //      'vender_code'=>isset($pancard_details['response']['code'])?$pancard_details['response']['code']:null,
              //      'status_code'=>200,
              //      'message_code'=>'success',
              //      "created_at"=> Carbon::now(),
              //      "updated_at"=> Carbon::now()
              //  ]);

            }
          }
          return response()->json(['pan' => $pancard, 'statusCode' => 200, 'success' => true, 'message' => null, "message_code" => "success"]);

        } catch (BadResponseException $e) {
          $response = $e->getResponse();
          $response = $e->getResponse();
          $errorResponse = json_decode($response->getBody(), true);
          $statusCode = $e->getResponse()->getStatusCode();
          return $errorResponse;
        }
      } else {
        return response()->json(['statusCode' => 103, 'message' => 'Please recharge your wallet.']);
      }
    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registerd.Please update your plan.']);
    }
  }



  public function new_aadhar(Request $request)
  {
    $statusCode = null;
    $api_id = null;
    $aadhar_validation = null;

    if (empty($request->aadhar)) {
      return response()->json((['message' => 'Aadhar Number is required', 'statusCode' => '404']));
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json((['message' => 'Header Access Token is required', 'statusCode' => '404']));
    }

    $verifyAccessToken = $this->verifyToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json(array(['message' => 'Wrong Access Token', 'statusCode' => '403']));
    }

    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
      if ($apiamster)
        $api_id = $apiamster->id;
    }


    $client = new Client();

    $headers = [
      'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
      'Referer' => $this->site_url
    ];

    $body = [
      'aadhaarNumber' => $request->aadhar,
      'demographicCheck' => true
    ];


    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();

    if ($updateHitCount || $user->role_id = 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1 && $user->type = 'role_postpaid') || $user->role_id = 0) {

        try {
          $res = $client->post('https://api.kyckart.com/api/aadhaar/basic-verification', ['headers' => $headers, 'json' => $body]);
          $aadhar_validation = json_decode($res->getBody(), true);
          if (isset($aadhar_validation['status']['statusCode']) && $aadhar_validation['status']['statusCode'] == 200 && $aadhar_validation['response']['code'] == 200) {
            $Aadhar_Validation['data']['AadhaarNumber'] = $request->aadhar;
            $Aadhar_Validation['data']['Code'] = isset($aadhar_validation['response']['code']) ? $aadhar_validation['response']['code'] : null;
            $Aadhar_Validation['data']['Verified'] = isset($aadhar_validation['response']['verified']) ? $aadhar_validation['response']['verified'] : null;
            $Aadhar_Validation['data']['ageBand'] = isset($aadhar_validation['response']['ageBand']) ? $aadhar_validation['response']['ageBand'] : null;
            $Aadhar_Validation['data']['Gender'] = isset($aadhar_validation['response']['gender']) ? $aadhar_validation['response']['gender'] : null;
            $Aadhar_Validation['data']['mobileNumber'] = isset($aadhar_validation['response']['mobileNumber']) ? $aadhar_validation['response']['mobileNumber'] : null;
            $Aadhar_Validation['data']['State'] = isset($aadhar_validation['response']['state']) ? $aadhar_validation['response']['state'] : null;

            if ($user->role_id == 1) {
              if ($apiamster) {

                $this->HitCount($user->id, $api_id, 'Transaction Successful', 200);
              }
              $aadharvalidation = DB::table('aadhar_validation')->insert([
                "user_id" => $user->id,
                "api_id" => $api_id,
                // "client_id"=> $aadhaar_validation['response']['client_id'],
                "aadhar_no" => $request->aadhar,
                "age_range" => $aadhar_validation['response']['ageBand'],
                "state" => $aadhar_validation['response']['state'],
                "gender" => $aadhar_validation['response']['gender'],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
              ]);

            }
            return response()->json(['statusCode' => 200, 'aadhar_validation' => $Aadhar_Validation]);
          }

        }


        // catch
        catch (BadResponseException $e) {
          $statusCode = $e->getResponse()->getStatusCode();
          $errorResponse = json_decode($e->getResponse()->getBody(), true);
          return $errorResponse;
          if ($statusCode == 500) {
            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
            if ($user->role_id == 1) {
              $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);

            }
          } else if ($statusCode == 404) {
            $statusCode = 102;
            $errorMessage = 'Verification Failed. Please enter correct Aadhar Number.';
            if ($user->role_id == 1) {

              if ($apiamster) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
              }
            }
          } else if ($statusCode == $errorResponse['status']['statusCode']) {
            $statusCode = 102;
            $errorMessage = $errorResponse['error']['message'];
            if ($user->role_id == 1) {
              if ($apiamster) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed', $errorResponse['status']['statusCode']);
              }
            }
          } else {
            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
            //  dd('tra');
            if ($user->role_id == 1) {
              if ($apiamster) {
                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
              }
            }
          }

          $aadharvalidation = DB::table('aadhar_validation')->insert([
            "user_id" => $user->id,
            "api_id" => $api_id,
            // "client_id"=> $aadhaar_validation['response']['client_id'],
            "aadhar_no" => $request->aadhar,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
          ]);
          return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
        }


      } else {
        return response()->json(['statusCode' => 500, 'message' => 'Please recharge your wallet.']);
      }

    } else {
      return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
    }

  }















  // rc
  public function new_rc_validationwithemptranew(Request $request)
  {

    $statusCode = null;
    $rc_validation = null;
    $api_id = null;
    $apiamster = null;
    $service_provider = 'KycKart';

    if (empty($request->rc)) {
      return response()->json(['message' => 'Rc Number is reuired', 'statusCode' => '404']);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json(['message' => 'Header Access Token is Required', 'statusCode' => '404']);
    }

    $VerifyAccessToken = $this->verifyToken($request->header('AccessToken'));
    if ($VerifyAccessToken == false) {
      return response()->json(['message' => 'Wrong Access Token', 'statusCode' => '403']);
    }

    $user = User::where('access_token', $request->header('AccessToken'))->first();
    if ($user->role_id == 1) {
      $apimaster = ApiMaster::where('api_slug', 'rc')->first();

      if ($apimaster) {
        $api_id = $apimaster->id;

      }
    }

    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type == "postpaid") {

        $rcNumber = str_replace('-', '', $request->rc);
        $subString = strtoupper(substr($rcNumber, 0, 2));
        $groupId = rand(100, 10000000000);
        $checkId = rand(100, 10000000000);


        if ($subString == 'AP' || $subString == 'AR' || $subString == 'AS' || $subString == 'BR' || $subString == 'CG' || $subString == 'GA' || $subString == 'GJ' || $subString == 'HR' || $subString == 'HP' || $subString == 'JH' || $subString == 'KA' || $subString == 'KL' || $subString == 'MP' || $subString == 'MH' || $subString == 'MN' || $subString == 'ML' || $subString == 'MZ' || $subString == 'NL' || $subString == 'OD' || $subString == 'PB' || $subString == 'RJ' || $subString == 'SK' || $subString == 'TN' || $subString == 'TR' || $subString == 'UP' || $subString == 'UK' || $subString == 'UA' || $subString == 'WB' || $subString == 'TS' || $subString == 'AN' || $subString == 'CH' || $subString == 'DN' || $subString == 'DD' || $subString == 'JK' || $subString == 'LA' || $subString == 'LD' || $subString == 'DL' || $subString == 'PY') {
          $currentMonth = date('Y-m');

          $rcdata = DB::table('rcvalidation')
            ->where('rc_number', $rcNumber)
            ->where('hit_month', $currentMonth)
            ->where('status_code', '200')
            ->orderby('id', 'DESC')
            ->first();

          try {
            $client = new Client();
            $headers = [
              'Accept' => 'application/json',
              'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
            ];
            $body = [
              'vehicleNumber' => $request->rc,
              'groupId' => $groupId,
              'checkId' => $checkId,
            ];

            // $rc_validation = [];
            $response = $client->post('https://api.kyckart.com/api/vehicle-registration/searchV4', [
              'headers' => $headers,
              'json' => $body,
            ]);
            $rc_validation_response = json_decode($response->getBody(), true);

            //return  $rc_validation_response;


            // number": "UP14FT0083",
            // "fuelType": "CNG ONLY",
            // "bodyType": "AUTO RICKSHAW (PASS)",
            // "normsDesc": "EURO 2",
            // "vehicleMMV": "BAJAJ AUTO LTD BAJAJ 3 WHEELER(AUTORICKSHAW)",
            // "companyName": "BAJAJ AUTO LTD",
            // "modelName": "BAJAJ 3 WHEELER(AUTORICKSHAW)",
            // "category": "3WT",
            // "color": "ECO,GREEN",
            // "chassis": "MD2A27AZ7FWH14411",
            // "class": "Three Wheeler (Passenger)(3WT)",
            // "engine": "AZZWFH31812",
            // "manufacturingDate": "11/2015",
            // "cubicCapacity": "200",
            // "grossWeight": "715",
            // "unladenWeight": "385",
            // "noCyl": "1",
            // "seatCap": "4",
            // "rcStandardCap": "0",
            // "sleeperCapacity": "0",
            // "standingCap": "0",
            // "wheelBase": "2025"
            //  vehicle response only
            if ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 200) {
              $vehicle_details['data']['Number'] = $rc_validation_response['response']['vehicle']['number'] ? $rc_validation_response['response']['vehicle']['number'] : null;
              $vehicle_details['data']['body_type'] = $rc_validation_response['response']['vehicle']['bodyType'] ? $rc_validation['data']['body_type'] = $rc_validation_response['response']['vehicle']['bodyType'] : null;
              $vehicle_details['data']['fuel_type'] = $rc_validation_response['response']['vehicle']['fuelType'] ? $rc_validation_response['response']['vehicle']['fuelType'] : null;
              $vehicle_details['data']['color'] = $rc_validation_response['response']['vehicle']['color'] ? $rc_validation_response['response']['vehicle']['color'] : null;
              $vehicle_details['data']['norms_type'] = null;
              $vehicle_details['data']['fit_up_to'] = null;
              $vehicle_details['data']['financer'] = $rc_validation_response['response']['hypotecationDetail']['financier'] ? $rc_validation_response['response']['hypotecationDetail']['financier'] : null;
              $vehicle_details['data']['insurance_company'] = $rc_validation_response['response']['insurance']['company'] ? $rc_validation_response['response']['insurance']['company'] : null;
              $vehicle_details['data']['insurance_policy_number'] = $rc_validation_response['response']['insurance']['policyNumber'] ? $rc_validation_response['response']['insurance']['policyNumber'] : null;
              $vehicle_details['data']['insurance_upto'] = null;
              $vehicle_details['data']['manufacturing_date'] = $rc_validation_response['response']['vehicle']['manufacturingDate'] ? $rc_validation_response['response']['vehicle']['manufacturingDate'] : null;
              $vehicle_details['data']['registered_at'] = null;
              $vehicle_details['data']['less_info'] = null;
              $vehicle_details['data']['cubic_capacity'] = $rc_validation_response['response']['vehicle']['cubicCapacity'] ? $rc_validation_response['response']['vehicle']['cubicCapacity'] : null;
              $vehicle_details['data']['vehicle_gross_weight'] = $rc_validation_response['response']['vehicle']['grossWeight'] ? $rc_validation_response['response']['vehicle']['grossWeight'] : null;

              $vehicle_details['data']['no_cylinders'] = $rc_validation_response['response']['vehicle']['noCyl'] ? $rc_validation_response['response']['vehicle']['noCyl'] : null;
              $vehicle_details['data']['seat_capacity'] = $rc_validation_response['response']['vehicle']['seatCap'] ? $rc_validation_response['response']['vehicle']['seatCap'] : null;
              $vehicle_details['data']['sleeper_capacity'] = $rc_validation_response['response']['vehicle']['sleeperCapacity'] ? $rc_validation_response['response']['vehicle']['sleeperCapacity'] : null;
              $vehicle_details['data']['standing_capacity'] = $rc_validation_response['response']['vehicle']['standingCap'] ? $rc_validation_response['response']['vehicle']['standingCap'] : null;

              $vehicle_details['data']['wheelbase'] = $rc_validation_response['response']['vehicle']['wheelBase'] ? $rc_validation_response['response']['vehicle']['wheelBase'] : null;
            }


            if ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 200) {
              $rc_validation['data']['client_id'] = null;
              $rc_validation['data']['rc_number'] = $rc_validation_response['response']['registrationDetail']['number'] ? $rc_validation_response['response']['registrationDetail']['number'] : null;
              $rc_validation['data']['registration_date'] = $rc_validation_response['response']['registrationDetail']['date'] ? $rc_validation_response['response']['registrationDetail']['date'] : null;
              $rc_validation['data']['owner_name'] = $rc_validation_response['response']['owner'] ? $rc_validation_response['response']['owner'] : null;
              $rc_validation['data']['owner_number'] = $rc_validation_response['response']['ownerNumber'] ? $rc_validation_response['response']['ownerNumber'] : null;
              $rc_validation['data']['father_name'] = $rc_validation_response['response']['ownerFathersName'] ? $rc_validation_response['response']['ownerFathersName'] : null;
              $rc_validation['data']['present_address'] = $rc_validation_response['response']['presentAddress'] ? $rc_validation_response['response']['presentAddress'] : null;
              $rc_validation['data']['permanent_address'] = $rc_validation_response['response']['permanentAddress'] ? $rc_validation_response['response']['permanentAddress'] : null;
              $rc_validation['data']['mobile_number'] = null;
              $rc_validation['data']['vehicle_category'] = $rc_validation_response['response']['vehicle']['category'] ? $rc_validation_response['response']['vehicle']['category'] : null;
              $rc_validation['data']['vehicle_chasi_number'] = $rc_validation_response['response']['vehicle']['chassis'] ? $rc_validation_response['response']['vehicle']['chassis'] : null;
              $rc_validation['data']['vehicle_engine_number'] = $rc_validation_response['response']['vehicle']['engine'] ? $rc_validation_response['response']['vehicle']['engine'] : null;
              $rc_validation['data']['maker_description'] = null;
              $rc_validation['data']['maker_model'] = $rc_validation_response['response']['vehicle']['modelName'] ? $rc_validation_response['response']['vehicle']['modelName'] : null;
              $rc_validation['data']['body_type'] = $rc_validation_response['response']['vehicle']['bodyType'] ? $rc_validation['data']['body_type'] = $rc_validation_response['response']['vehicle']['bodyType'] : null;
              $rc_validation['data']['fuel_type'] = $rc_validation_response['response']['vehicle']['fuelType'] ? $rc_validation_response['response']['vehicle']['fuelType'] : null;
              $rc_validation['data']['color'] = $rc_validation_response['response']['vehicle']['color'] ? $rc_validation_response['response']['vehicle']['color'] : null;
              $rc_validation['data']['norms_type'] = null;
              $rc_validation['data']['fit_up_to'] = null;
              $rc_validation['data']['financer'] = $rc_validation_response['response']['hypotecationDetail']['financier'] ? $rc_validation_response['response']['hypotecationDetail']['financier'] : null;
              $rc_validation['data']['insurance_company'] = $rc_validation_response['response']['insurance']['company'] ? $rc_validation_response['response']['insurance']['company'] : null;
              $rc_validation['data']['insurance_policy_number'] = $rc_validation_response['response']['insurance']['policyNumber'] ? $rc_validation_response['response']['insurance']['policyNumber'] : null;
              $rc_validation['data']['insurance_upto'] = null;
              $rc_validation['data']['manufacturing_date'] = $rc_validation_response['response']['vehicle']['manufacturingDate'] ? $rc_validation_response['response']['vehicle']['manufacturingDate'] : null;
              $rc_validation['data']['registered_at'] = null;
              $rc_validation['data']['less_info'] = null;
              $rc_validation['data']['cubic_capacity'] = $rc_validation_response['response']['vehicle']['cubicCapacity'] ? $rc_validation_response['response']['vehicle']['cubicCapacity'] : null;
              $rc_validation['data']['vehicle_gross_weight'] = $rc_validation_response['response']['vehicle']['grossWeight'] ? $rc_validation_response['response']['vehicle']['grossWeight'] : null;

              $rc_validation['data']['no_cylinders'] = $rc_validation_response['response']['vehicle']['noCyl'] ? $rc_validation_response['response']['vehicle']['noCyl'] : null;
              $rc_validation['data']['seat_capacity'] = $rc_validation_response['response']['vehicle']['seatCap'] ? $rc_validation_response['response']['vehicle']['seatCap'] : null;
              $rc_validation['data']['sleeper_capacity'] = $rc_validation_response['response']['vehicle']['sleeperCapacity'] ? $rc_validation_response['response']['vehicle']['sleeperCapacity'] : null;
              $rc_validation['data']['standing_capacity'] = $rc_validation_response['response']['vehicle']['standingCap'] ? $rc_validation_response['response']['vehicle']['standingCap'] : null;

              $rc_validation['data']['wheelbase'] = $rc_validation_response['response']['vehicle']['wheelBase'] ? $rc_validation_response['response']['vehicle']['wheelBase'] : null;
              $rc_validation['data']['unladen_weight'] = $rc_validation_response['response']['vehicle']['unladenWeight'] ? $rc_validation_response['response']['vehicle']['unladenWeight'] : null;
              $rc_validation['data']['vehicle_category_description'] = null;
              $rc_validation['data']['pucc_number'] = $rc_validation_response['response']['pucc']['number'] ? $rc_validation_response['response']['pucc']['number'] : null;
              if (isset($rc_validation_response['response']['pucc']['upto']) && $rc_validation_response['response']['pucc']['upto'] != null && $rc_validation_response['response']['pucc']['upto'] != 'null' && $rc_validation_response['response']['pucc']['upto'] != 'NA') {
                $rc_validation['data']['pucc_upto'] = $rc_validation_response['response']['pucc']['upto'];
              }
              $rc_validation['data']['masked_name'] = null;
              $rc_validation['data']['permit_issue_date'] = $rc_validation_response['response']['permitDetails']['permitIssueDate'] ? $rc_validation_response['response']['permitDetails']['permitIssueDate'] : null;
              $rc_validation['data']['permit_number'] = $rc_validation_response['response']['permitDetails']['permitNumber'] ? $rc_validation_response['response']['permitDetails']['permitNumber'] : null;
              $rc_validation['data']['permit_type'] = $rc_validation_response['response']['permitDetails']['permitType'] ? $rc_validation_response['response']['permitDetails']['permitType'] : null;
              $rc_validation['data']['permit_valid_from'] = $rc_validation_response['response']['permitDetails']['permitValidFrom'] ? $rc_validation_response['response']['permitDetails']['permitValidFrom'] : null;
              $rc_validation['data']['permit_valid_upto'] = $rc_validation_response['response']['permitDetails']['nationalPermitUpto'] ? $rc_validation_response['response']['permitDetails']['nationalPermitUpto'] : null;
              $rc_validation['data']['national_permit_issued_by'] = $rc_validation_response['response']['permitDetails']['nationalPermitIssuedBy'] ? $rc_validation_response['response']['permitDetails']['nationalPermitIssuedBy'] : null;
              $rc_validation['data']['national_permit_number'] = $rc_validation_response['response']['permitDetails']['nationalPermitNumber'] ? $rc_validation_response['response']['permitDetails']['nationalPermitNumber'] : null;
              $rc_validation['data']['national_permit_upto'] = $rc_validation_response['response']['permitDetails']['nationalPermitUpto'] ? $rc_validation_response['response']['permitDetails']['nationalPermitUpto'] : null;
              $rc_validation['data']['blacklist_status'] = $rc_validation_response['response']['registrationDetail']['blacklistStatus'] ? $rc_validation_response['response']['registrationDetail']['blacklistStatus'] : null;
              $rc_validation['data']['blacklist_details'] = $rc_validation_response['response']['registrationDetail']['blacklistDetails'] ? $rc_validation_response['response']['registrationDetail']['blacklistDetails'] : null;
              $rc_validation['data']['rto_code'] = $rc_validation_response['response']['registrationDetail']['RTOCode'] ? $rc_validation_response['response']['registrationDetail']['RTOCode'] : null;
              $rc_validation['data']['latest_by'] = $rc_validation_response['response']['registrationDetail']['rcStatusAsOn'] ? $rc_validation_response['response']['registrationDetail']['rcStatusAsOn'] : null;
              $rc_validation['data']['tax_upto'] = $rc_validation_response['response']['registrationDetail']['taxUpto'] ? $rc_validation_response['response']['registrationDetail']['taxUpto'] : null;
              $rc_validation['data']['noc_details'] = $rc_validation_response['response']['registrationDetail']['nocDetails'] ? $rc_validation_response['response']['registrationDetail']['nocDetails'] : null;
              $rc_validation['data']['number'] = $rc_validation_response['response']['registrationDetail']['number'] ? $rc_validation_response['response']['registrationDetail']['number'] : null;
              $rc_validation['data']['rc_status'] = $rc_validation_response['response']['registrationDetail']['rcStatus'] ? $rc_validation_response['response']['registrationDetail']['rcStatus'] : null;
              $rc_validation['data']['authority'] = $rc_validation_response['response']['registrationDetail']['authority'] ? $rc_validation_response['response']['registrationDetail']['authority'] : null;
              $rc_validation['data']['non_use_to'] = $rc_validation_response['response']['nonUseDetails']['nonUseTo'] ? $rc_validation_response['response']['nonUseDetails']['nonUseTo'] : null;
              $rc_validation['data']['non_use_from'] = $rc_validation_response['response']['nonUseDetails']['nonUseFrom'] ? $rc_validation_response['response']['nonUseDetails']['nonUseFrom'] : null;
              $rc_validation['data']['non_use_status'] = $rc_validation_response['response']['nonUseDetails']['nonUseStatus'] ? $rc_validation_response['response']['nonUseDetails']['nonUseStatus'] : null;

              // return $rc_validation;


              // store rc_details
              if ($user->role_id == 1) {

                if ($apimaster) {

                  $this->HitCount($user->id, $api_id, 'Transaction Successful', 200);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'client_id' => null,
                  'transaction_id' => $rc_validation_response['status']['transactionId'],
                  'status_code' => 200,
                  'status_code_vender' => $rc_validation_response['status']['statusCode'],
                  'code_vender' => $rc_validation_response['response']['code'],
                  'rc_number' => $rc_validation_response['response']['registrationDetail']['number'],
                  'rc_status' => $rc_validation_response['response']['registrationDetail']['rcStatus'],
                  'owner_number' => $rc_validation_response['response']['ownerNumber'],
                  'tax_upto' => $rc_validation_response['response']['registrationDetail']['taxUpto'],
                  'blacklist_status' => $rc_validation_response['response']['registrationDetail']['blacklistStatus'],
                  'father_name' => $rc_validation_response['response']['ownerFathersName'],
                  'registration_date' => $rc_validation['data']['registration_date'],
                  'owner_name' => $rc_validation['data']['owner_name'],
                  'present_address' => $rc_validation['data']['present_address'],
                  'permanent_address' => $rc_validation['data']['permanent_address'],
                  'mobile_number' => null,
                  'vehicle_category' => $rc_validation['data']['vehicle_category'],
                  'vehicle_chasi_number' => $rc_validation['data']['vehicle_chasi_number'],
                  'vehicle_engine_number' => $rc_validation['data']['vehicle_engine_number'],
                  'maker_description' => null,
                  'maker_model' => $rc_validation['data']['maker_model'],
                  'body_type' => $rc_validation['data']['body_type'],
                  'fuel_type' => $rc_validation['data']['fuel_type'],
                  'color' => $rc_validation['data']['color'],
                  'norms_type' => $rc_validation['data']['norms_type'],
                  'fit_up_to' => $rc_validation['data']['fit_up_to'],
                  'financer' => $rc_validation['data']['financer'],
                  'insurance_company' => $rc_validation['data']['insurance_company'],
                  'insurance_policy_number' => $rc_validation['data']['insurance_policy_number'],
                  'insurance_upto' => $rc_validation['data']['insurance_upto'],
                  'manufacturing_date' => $rc_validation['data']['manufacturing_date'],
                  'registered_at' => null,
                  'less_info' => 1,
                  'cubic_capacity' => $rc_validation['data']['cubic_capacity'],
                  'vehicle_gross_weight' => $rc_validation['data']['vehicle_gross_weight'],
                  'no_cylinders' => $rc_validation['data']['no_cylinders'],
                  'seat_capacity' => $rc_validation['data']['seat_capacity'],
                  'sleeper_capacity' => $rc_validation['data']['sleeper_capacity'],
                  'standing_capacity' => $rc_validation['data']['standing_capacity'],
                  'wheelbase' => $rc_validation['data']['wheelbase'],
                  'unladen_weight' => $rc_validation['data']['unladen_weight'],
                  'vehicle_category_description' => null,
                  'pucc_number' => $rc_validation['data']['pucc_number'],
                  'pucc_upto' => $rc_validation['data']['pucc_upto'],
                  'hit_month' => date('Y-m'),
                  'national_permit_issued_by' => $rc_validation_response['response']['permitDetails']['nationalPermitIssuedBy'],
                  'national_permit_number' => $rc_validation_response['response']['permitDetails']['nationalPermitNumber'],
                  'national_permit_upto' => $rc_validation_response['response']['permitDetails']['nationalPermitUpto'],
                  'permit_type' => $rc_validation_response['response']['permitDetails']['permitType'],
                  'permit_valid_from' => $rc_validation_response['response']['permitDetails']['permitValidFrom'],
                  'permit_number' => $rc_validation_response['response']['permitDetails']['permitNumber'],
                  'permit_valid_upto' => $rc_validation_response['response']['permitDetails']['permitValidUpto'],
                  'permit_issue_date' => $rc_validation_response['response']['permitDetails']['permitIssueDate'],
                  'noc_details' => $rc_validation_response['response']['registrationDetail']['nocDetails'],
                  'latest_by' => $rc_validation_response['response']['registrationDetail']['rcStatusAsOn'],
                  'message_code' => null,
                  'non_use_to' => $rc_validation_response['response']['nonUseDetails']['nonUseTo'],
                  'non_use_from' => $rc_validation_response['response']['nonUseDetails']['nonUseFrom'],
                  'non_use_status' => $rc_validation_response['response']['nonUseDetails']['nonUseStatus'],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['rc_validation' => $rc_validation, 'status_code' => 200, 'success' => true, 'message' => null, 'message_code' => 'success']);
              
            } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 1003) {
              $statusCode = 102;
              $errorMessage = 'Record not found';
              if ($user->role_id == 1) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed', 102);
                // $this->update_transac($user->id, $api_id, 0, 'Transaction Failed.', 201);
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code_vender' => $rc_validation_response['status']['statusCode'],
                  'code_vender' => $rc_validation_response['response']['code'],
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 1007) {
              $statusCode = 200;
              $errorMessage = 'RC Number in Multiple RTOs';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->HitCount($user->id, $api_id, 'Transaction Successful', 200);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'status_code_vender' => $rc_validation_response['status']['statusCode'],
                  'code_vender' => $rc_validation_response['response']['code'],
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 404) {
              $statusCode = 102;
              $errorMessage = 'Record does not exist in records';
              if ($user->role_id == 1) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed', 102);
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'status_code_vender' => $rc_validation_response['status']['statusCode'],
                  'code_vender' => $rc_validation_response['response']['code'],
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } else {
              $statusCode = 500;
              $errorMessage = 'Internal server error.';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => 500,
                  'status_code_vender' => $rc_validation_response['status']['statusCode'],
                  'code_vender' => $rc_validation_response['response']['code'],
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            }

          } catch (BadResponseException $e) {
            $response = $e->getResponse();
            // return $response;
            $errorResponse = json_decode($response->getBody(), true);
            $statusCode = $e->getResponse()->getStatusCode();
            // return $errorResponse['error']['code'];
            // return $statusCode;
            //return   $errorResponse;
            if ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002') {
              $statusCode = 102;
              $errorMessage = 'Invalid Vehicle Number Please Enter Correct Vehicle Number.';
              if ($user->role_id == 1) {
                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }

              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 205) {
              $statusCode = 201;
              $errorMessage = 'API Failed due to internal error.';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed.', 201);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1004) {
              $statusCode = 401;
              $errorMessage = 'Sorry, RTO website is down for maintenance, we will inform you once it is back.';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', 401);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'rc_number' => $rcNumber,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1006) {
              $statusCode = 102;
              $errorMessage = 'Invalid Vehicle Number. Please enter valid vehicle number.';
              if ($user->role_id == 1) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1008) {
              $statusCode = 201;
              $errorMessage = 'Record Not Found/Invalid Rc Number.';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', 201);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 500) {
              $statusCode = 500;
              $errorMessage = 'Internal Server error';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            } else {
              $statusCode = 500;
              $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
              if ($user->role_id == 1) {
                if ($apiamster) {
                  $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                }
                $rcvalidation = DB::table('rcvalidation')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'groupId' => $groupId,
                  'checkId' => $checkId,
                  'status_code' => $statusCode,
                  'rc_number' => $rcNumber,
                  'status_code_vender' => $errorResponse['status']['statusCode'],
                  'code_vender' => $errorResponse['error']['code'],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                  'service_provider' => $service_provider,
                ]);
              }
              return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            }
          }


        } else {
          return response()->json(['statusCode' => 102, 'message' => 'Verification Failed. Please enter correct State Code.']);
        }

      } else {
        return response()->json(['message' => 'Please Recharge Your Wallet', 'statusCode' => '500']);
      }

    } else {
      return response()->json(['statusCode' => '103', 'message' => 'You are not registered to use this service. Please update your plan.']);
    }

  }






  // new pan ocr

  public function new_pan_ocr(Request $request)
  {
    $api_id = null;
    $statusCode = null;
    if (empty($request->hasFile('file'))) {
      return response()->json(['message' => 'file is required', 'statusCode' => '404']);
    }

    if (!$request->headers->has('AccessToken')) {
      return response()->json(['message' => 'AccessToken is required', 'statusCode' => '404']);
    }

    $verifyAccessToken = $this->verifyToken($request->header('AccessToken'));
    if ($verifyAccessToken == false) {
      return response()->json(['message' => 'Wrong Access Token', 'statusCode' => '403']);
    }

    $user = User::where('access_token', $request->header('AccessToken'))->first();

    if ($user->role_id == 1) {
      $apimaster = ApiMaster::where('api_slug', 'pancardocrtwo')->first();
      if ($apimaster) {
        $api_id = $apimaster->id;
      }
    }

    $headers = [
      'Accept' => 'Application/json'
    ];

    $body = $request->file;

    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->orderBy('id', 'desc')->first();
    if ($updateHitCount || $user->role_id == 0) {
      if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0) {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'http://13.127.202.182:8080/panocr',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
          // CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($request->file('file')->getPathname(), $request->file('file')->getMimeType(), $request->file('file')->getClientOriginalName())],

        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $pancard = json_decode($response, true);
        // return $pancard;
        //  return $pancard;
        if (isset($pancard['raw_ocr_texts']) && $pancard['pan_number'] != null) {
          $statusCode = 200;
          if ($user->role_id == 1 || $user->role_id == 0) {
            if ($user->role_id == 1) {
              if ($apimaster) {
                $this->HitCount($user->id, $api_id, 'Transaction Successful', 200);
              }
            }
            $paninfo = DB::table('pancard_varification')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'name' => isset($pancard['name']) ? $pancard['name'] : null,
              'dob' => isset($pancard['date_of_birth']) ? $pancard['date_of_birth'] : null,
              'pancard_id' => isset($pancard['pan_number']) ? $pancard['pan_number'] : null,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['status_code' => 200, 'pancard' => $pancard]);
        } elseif (isset($pancard['raw_ocr_texts']) && $pancard['pan_number'] == null || $pancard == null) {
          $statusCode = 102;
          if ($user->role_id == 1 || $user->role_id == 0) {
            if ($user->role_id == 1) {
              if ($apimaster) {
                $this->HitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
              }
            }
            $paninfo = DB::table('pancard_varification')->insert([
              'user_id' => $user->id,
              'api_id' => $api_id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
          return response()->json(['message' => 'invalid file type, must be Pan Image', 'statusCode' => $statusCode]);
        }

        else {
          $statusCode = 500;
          $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
          if ($user->role_id == 1 || $user->role_id == 0) {
              if ($user->role_id == 1) {
                  if ($apimaster) {
                      $this->update_transac($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                  }
              }
              $paninfo = DB::table('pancard_varification')->insert([
                  'user_id' => $user->id,
                  'api_id' => $api_id,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
              ]);
          }
          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
      }
      } else {
        return response()->json(['message' => 'Recharge Your Wallet', 'statusCode']);
      }
    } else {
      return response()->json(['message' => 'You are not registered to use this service', 'statusCode' => '103']);
    }
  }
}