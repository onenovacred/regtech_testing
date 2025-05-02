<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BankAnalyser\ICICI;
use App\Helpers\BankAnalyser\Indian;
use App\Helpers\BankAnalyser\HDFC;
use App\Helpers\BankAnalyser\Kotak;
use App\Helpers\BankAnalyser\BankofIndia;
use App\Helpers\BankReader;

class BankStatementAndBankAnalyserController extends Controller
{
    public function bankAnalyser(Request $request){
        $api_id = null;
        if (!$request->hasFile('bankStemt')) {
            return json_encode(['message'=>"file not found"], true);
        }
        if(!$request->headers->has('AccessToken'))
            return response()->json(array(['message'=>'Header Access Token is required','statusCode'=>'404']));
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken==false)
            return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
    
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if($user->role_id==1) {
            $apiamster = ApiMaster::where('api_slug','bank_anlyser')->first();
            if($apiamster)
                $api_id = $apiamster->id;
               
        }
        $client = new Client();
        $updateHitCount = UserSchemeMaster::where('user_id',$user->id)->where('api_id',$api_id)->orderBy('id', 'desc')->first(); 
        if($updateHitCount || $user->role_id==0){
          if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                 $curl = curl_init();
                 curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://13.233.136.139:8080/analyser',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => ['pdf'=> new \CURLFILE($_FILES['bankStemt']['tmp_name'], $_FILES['bankStemt']['type'], $_FILES['bankStemt']['name']),
                  'bankName'=>$request->bankName,
                  'accountType'=>$request->accountType,
                  'password'=>$request->password
                  ],
                ));

                $response = curl_exec($curl);
                $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                $bank_analyser = json_decode($response, true);
                if ((isset($bank_analyser['statuscode']) && $bank_analyser['statuscode']==200) && isset($bank_analyser['Data']['average_balance'])) {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    }
                    $bankName = $request->bankName;
                    $bankAnalyser = $bank_analyser['Data'];
                    $bankfinalanalyserResponse=null;
                    switch($bankName) {
                        case 'ICICI Bank':
                            $bankfinalanalyserResponse = [
                                "atm_withdrawls" =>isset($bankAnalyser['withdrawal_transactions'])?ICICI::atm_withdrawls($bankAnalyser['withdrawal_transactions']):[],
                                "averageMonthlyBalance"=>isset($bankAnalyser['monthwise_stats'])?ICICI::averageMonthlyBalance($bankAnalyser['monthwise_stats']):[],
                                "averageQuarterlyBalance"=>[
                                    [
                                        "netAverageBalance"=>null,
                                        "monthAndYear"=>null,
                                    ],
                                ],
                                 "bank_account"=>[
                                    "accountDetailsForAccountListPage" =>null,
                                    "accountHolder" => "[]",
                                    "accountLimit" => null,
                                    "accountNo" =>null,
                                    "accountType" => [
                                        "enumType" =>null,
                                        "name" =>null
                                    ],
                                    "address" => "[]",
                                    "availableCashLimit" => null,
                                    "availableCreditLimit" => null,
                                    "bank" => [
                                        "enumType" =>null,
                                        "name" =>null
                                    ],
                                    "bankAccountUID" =>null,
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
                                "cash_deposits"=>isset($bankAnalyser['deposit_transactions'])?ICICI::cashDeposits($bankAnalyser['deposit_transactions']):[],
                                "expenses"=>[
                                      [
                                        "amount" => null,
                                        "bank" => null,
                                        "category" =>null,
                                        "date" =>null,
                                        "description" =>null,
                                        "merchantType" => null,
                                        "mode" =>null,
                                        "monthAndYear" => null,
                                        "partyName" => null,
                                        "purpose" =>null,
                                        "total" => null
                                      ]
                                      ],
                                "high_value_transactions"=>[
                                     [
                                        "amount"=>null,
                                        "balanceAfterTranscation"=>null,
                                        "bank"=>null,
                                        "category"=>null,
                                        "date"=>null,
                                        "description"=>null,
                                        "type"=>null
                                     ],
                                 
                                    ],
                                 "incomes"=>[
                                    [
                                        "amount"=>null,
                                        "balanceAfterTransaction"=>null,
                                        "bank"=> null,
                                        "category"=>null,
                                        "date"=>null,
                                        "description"=>null,
                                        "isSalary"=>null,
                                        "isSalaryCheck"=>null,
                                        "mode"=>null,
                                        "monthAndYear"=>null,
                                        "partyName"=> null,
                                        "purpose"=> null,
                                        "total"=>null,
                                        "transactionType"=>null
                                    ]
                                    ],
                                 "internalTransactionList"=>[],
                                 "investments"=>[
                                    [
                                        "amount"=>null,
                                        "balanceAfterTransaction"=>null,
                                        "bank"=>null,
                                        "category"=>null,
                                        "date"=>null,
                                        "description"=>null,
                                        "transactionSubCategory"=>null,
                                        "type"=>null
                                    ]
                                    ],
                                 "minimum_balances"=>isset($bankAnalyser['monthwise_stats'])?ICICI::minimumBalance($bankAnalyser['monthwise_stats']):[],
                                  "missingMonths"=>[],
                                  "money_received_transactions"=>[
                                    [
                                        "amount"=>null,
                                        "balanceAfterTransaction"=>null,
                                        "bank"=>null,
                                        "category"=>null,
                                        "date"=>null,
                                        "description"=>null,
                                        "monthAndYear"=>null,
                                        "total"=>null,
                                        "transactionType"=>null
                                    ],
                                  ],
                                  "inward_cheque_return"=>[
                                     [
                                        "date"=>null,
                                        "amount"=>null,
                                        "description"=>null,
                                        "balance"=>null,
                                        "category"=>null,
                                        "remark"=> null,
                                        "transactionType"=>null,
                                        "bank"=>null,
                                      ]
                                   ],
                                   "salary"=>[
                                    "average"=>isset($bankAnalyser['average_balance'])?$bankAnalyser['average_balance']:null,
                                    "monthlyDetails"=> [
                                        [
                                            "monthYear"=>null,
                                            "total"=>null,
                                            "value"=>null
                                        ]
                                    ],
                                    "total"=>isset($bankAnalyser['total_balance'])?$bankAnalyser['total_balance']:null,
                                    "totalValue"=>isset($bankAnalyser['total_deposit'])?$bankAnalyser['total_deposit']:null
                                ]
                             ];
                            break;
                          case 'Indian Bank':
                                $bankfinalanalyserResponse = [
                                    "atm_withdrawls" =>isset($bankAnalyser['withdrawal_transactions'])?Indian::atm_withdrawls($bankAnalyser['withdrawal_transactions']):[],
                                    "averageMonthlyBalance"=>isset($bankAnalyser['monthwise_stats'])?Indian::averageMonthlyBalance($bankAnalyser['monthwise_stats']):[],
                                    "averageQuarterlyBalance"=>[
                                        [
                                            "netAverageBalance"=>null,
                                            "monthAndYear"=>null,
                                        ],
                                    ],
                                     "bank_account"=>[
                                        "accountDetailsForAccountListPage" =>null,
                                        "accountHolder" => "[]",
                                        "accountLimit" => null,
                                        "accountNo" =>null,
                                        "accountType" => [
                                            "enumType" =>null,
                                            "name" =>null
                                        ],
                                        "address" => "[]",
                                        "availableCashLimit" => null,
                                        "availableCreditLimit" => null,
                                        "bank" => [
                                            "enumType" =>null,
                                            "name" =>null
                                        ],
                                        "bankAccountUID" =>null,
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
                                    "cash_deposits"=>isset($bankAnalyser['deposit_transactions'])?Indian::cashDeposits($bankAnalyser['deposit_transactions']):[],
                                    "expenses"=>[
                                          [
                                            "amount" => null,
                                            "bank" => null,
                                            "category" =>null,
                                            "date" =>null,
                                            "description" =>null,
                                            "merchantType" => null,
                                            "mode" =>null,
                                            "monthAndYear" => null,
                                            "partyName" => null,
                                            "purpose" =>null,
                                            "total" => null
                                          ]
                                          ],
                                    "high_value_transactions"=>[
                                         [
                                            "amount"=>null,
                                            "balanceAfterTranscation"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "type"=>null
                                         ],
                                     
                                        ],
                                     "incomes"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=> null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "isSalary"=>null,
                                            "isSalaryCheck"=>null,
                                            "mode"=>null,
                                            "monthAndYear"=>null,
                                            "partyName"=> null,
                                            "purpose"=> null,
                                            "total"=>null,
                                            "transactionType"=>null
                                        ]
                                        ],
                                     "internalTransactionList"=>[],
                                     "investments"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "transactionSubCategory"=>null,
                                            "type"=>null
                                        ]
                                        ],
                                     "minimum_balances"=>isset($bankAnalyser['monthwise_stats'])?Indian::minimumBalance($bankAnalyser['monthwise_stats']):[],
                                      "missingMonths"=>[],
                                      "money_received_transactions"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "monthAndYear"=>null,
                                            "total"=>null,
                                            "transactionType"=>null
                                        ],
                                      ],
                                      "inward_cheque_return"=>[
                                         [
                                            "date"=>null,
                                            "amount"=>null,
                                            "description"=>null,
                                            "balance"=>null,
                                            "category"=>null,
                                            "remark"=> null,
                                            "transactionType"=>null,
                                            "bank"=>null,
                                          ]
                                       ],
                                       "salary"=>[
                                        "average"=>isset($bankAnalyser['average_balance'])?$bankAnalyser['average_balance']:null,
                                        "monthlyDetails"=> [
                                            [
                                                "monthYear"=>null,
                                                "total"=>null,
                                                "value"=>null
                                            ]
                                        ],
                                        "total"=>isset($bankAnalyser['total_balance'])?$bankAnalyser['total_balance']:null,
                                        "totalValue"=>isset($bankAnalyser['total_deposit'])?$bankAnalyser['total_deposit']:null
                                    ]
                                 ];
                                break;
                           case 'Hdfc Bank':
                                $bankfinalanalyserResponse = [
                                    "atm_withdrawls" =>isset($bankAnalyser['withdrawal_transactions'])?HDFC::atm_withdrawls($bankAnalyser['withdrawal_transactions']):[],
                                    "averageMonthlyBalance"=>isset($bankAnalyser['monthwise_stats'])?HDFC::averageMonthlyBalance($bankAnalyser['monthwise_stats']):[],
                                    "averageQuarterlyBalance"=>[
                                        [
                                            "netAverageBalance"=>null,
                                            "monthAndYear"=>null,
                                        ],
                                    ],
                                     "bank_account"=>[
                                        "accountDetailsForAccountListPage" =>null,
                                        "accountHolder" => "[]",
                                        "accountLimit" => null,
                                        "accountNo" =>null,
                                        "accountType" => [
                                            "enumType" =>null,
                                            "name" =>null
                                        ],
                                        "address" => "[]",
                                        "availableCashLimit" => null,
                                        "availableCreditLimit" => null,
                                        "bank" => [
                                            "enumType" =>null,
                                            "name" =>null
                                        ],
                                        "bankAccountUID" =>null,
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
                                    "cash_deposits"=>isset($bankAnalyser['deposit_transactions'])?HDFC::cashDeposits($bankAnalyser['deposit_transactions']):[],
                                    "expenses"=>[
                                          [
                                            "amount" => null,
                                            "bank" => null,
                                            "category" =>null,
                                            "date" =>null,
                                            "description" =>null,
                                            "merchantType" => null,
                                            "mode" =>null,
                                            "monthAndYear" => null,
                                            "partyName" => null,
                                            "purpose" =>null,
                                            "total" => null
                                          ]
                                          ],
                                    "high_value_transactions"=>[
                                         [
                                            "amount"=>null,
                                            "balanceAfterTranscation"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "type"=>null
                                         ],
                                     
                                        ],
                                     "incomes"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=> null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "isSalary"=>null,
                                            "isSalaryCheck"=>null,
                                            "mode"=>null,
                                            "monthAndYear"=>null,
                                            "partyName"=> null,
                                            "purpose"=> null,
                                            "total"=>null,
                                            "transactionType"=>null
                                        ]
                                        ],
                                     "internalTransactionList"=>[],
                                     "investments"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "transactionSubCategory"=>null,
                                            "type"=>null
                                        ]
                                        ],
                                      "minimum_balances"=>isset($bankAnalyser['monthwise_stats'])?HDFC::minimumBalance($bankAnalyser['monthwise_stats']):[],
                                      "missingMonths"=>[],
                                      "money_received_transactions"=>[
                                        [
                                            "amount"=>null,
                                            "balanceAfterTransaction"=>null,
                                            "bank"=>null,
                                            "category"=>null,
                                            "date"=>null,
                                            "description"=>null,
                                            "monthAndYear"=>null,
                                            "total"=>null,
                                            "transactionType"=>null
                                        ],
                                      ],
                                      "inward_cheque_return"=>[
                                         [
                                            "date"=>null,
                                            "amount"=>null,
                                            "description"=>null,
                                            "balance"=>null,
                                            "category"=>null,
                                            "remark"=> null,
                                            "transactionType"=>null,
                                            "bank"=>null,
                                          ]
                                       ],
                                       "salary"=>[
                                        "average"=>isset($bankAnalyser['average_balance'])?$bankAnalyser['average_balance']:null,
                                        "monthlyDetails"=> [
                                            [
                                                "monthYear"=>null,
                                                "total"=>null,
                                                "value"=>null
                                            ]
                                        ],
                                        "total"=>isset($bankAnalyser['total_balance'])?$bankAnalyser['total_balance']:null,
                                        "totalValue"=>isset($bankAnalyser['total_deposit'])?$bankAnalyser['total_deposit']:null
                                    ]
                                 ];   
                                 break;
                                 case 'Kotak Bank':
                                    $bankfinalanalyserResponse = [
                                        "atm_withdrawls" =>isset($bankAnalyser['withdrawal_transactions'])?Kotak::atm_withdrawls($bankAnalyser['withdrawal_transactions']):[],
                                        "averageMonthlyBalance"=>isset($bankAnalyser['monthwise_stats'])?Kotak::averageMonthlyBalance($bankAnalyser['monthwise_stats']):[],
                                        "averageQuarterlyBalance"=>[
                                            [
                                                "netAverageBalance"=>null,
                                                "monthAndYear"=>null,
                                            ],
                                        ],
                                         "bank_account"=>[
                                            "accountDetailsForAccountListPage" =>null,
                                            "accountHolder" => "[]",
                                            "accountLimit" => null,
                                            "accountNo" =>null,
                                            "accountType" => [
                                                "enumType" =>null,
                                                "name" =>null
                                            ],
                                            "address" => "[]",
                                            "availableCashLimit" => null,
                                            "availableCreditLimit" => null,
                                            "bank" => [
                                                "enumType" =>null,
                                                "name" =>null
                                            ],
                                            "bankAccountUID" =>null,
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
                                        "cash_deposits"=>isset($bankAnalyser['deposit_transactions'])?Kotak::cashDeposits($bankAnalyser['deposit_transactions']):[],
                                        "expenses"=>[
                                              [
                                                "amount" => null,
                                                "bank" => null,
                                                "category" =>null,
                                                "date" =>null,
                                                "description" =>null,
                                                "merchantType" => null,
                                                "mode" =>null,
                                                "monthAndYear" => null,
                                                "partyName" => null,
                                                "purpose" =>null,
                                                "total" => null
                                              ]
                                              ],
                                        "high_value_transactions"=>[
                                             [
                                                "amount"=>null,
                                                "balanceAfterTranscation"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "type"=>null
                                             ],
                                         
                                            ],
                                         "incomes"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=> null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "isSalary"=>null,
                                                "isSalaryCheck"=>null,
                                                "mode"=>null,
                                                "monthAndYear"=>null,
                                                "partyName"=> null,
                                                "purpose"=> null,
                                                "total"=>null,
                                                "transactionType"=>null
                                            ]
                                            ],
                                         "internalTransactionList"=>[],
                                         "investments"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "transactionSubCategory"=>null,
                                                "type"=>null
                                            ]
                                            ],
                                         "minimum_balances"=>isset($bankAnalyser['monthwise_stats'])?Kotak::minimumBalance($bankAnalyser['monthwise_stats']):[],
                                          "missingMonths"=>[],
                                          "money_received_transactions"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "monthAndYear"=>null,
                                                "total"=>null,
                                                "transactionType"=>null
                                            ],
                                          ],
                                          "inward_cheque_return"=>[
                                             [
                                                "date"=>null,
                                                "amount"=>null,
                                                "description"=>null,
                                                "balance"=>null,
                                                "category"=>null,
                                                "remark"=> null,
                                                "transactionType"=>null,
                                                "bank"=>null,
                                              ]
                                           ],
                                           "salary"=>[
                                            "average"=>isset($bankAnalyser['average_balance'])?$bankAnalyser['average_balance']:null,
                                            "monthlyDetails"=> [
                                                [
                                                    "monthYear"=>null,
                                                    "total"=>null,
                                                    "value"=>null
                                                ]
                                            ],
                                            "total"=>isset($bankAnalyser['total_balance'])?$bankAnalyser['total_balance']:null,
                                            "totalValue"=>isset($bankAnalyser['total_deposit'])?$bankAnalyser['total_deposit']:null
                                        ]
                                     ];
                                     break;
                                  case 'Bank of India': 
                                    $bankfinalanalyserResponse = [
                                        "atm_withdrawls" =>isset($bankAnalyser['withdrawal_transactions'])?BankofIndia::atm_withdrawls($bankAnalyser['withdrawal_transactions']):[],
                                        "averageMonthlyBalance"=>isset($bankAnalyser['withdrawal_transactions'])?BankofIndia::averageMonthlyBalance($bankAnalyser['monthwise_stats']):[],
                                        "averageQuarterlyBalance"=>[
                                            [
                                                "netAverageBalance"=>null,
                                                "monthAndYear"=>null,
                                            ],
                                        ],
                                         "bank_account"=>[
                                            "accountDetailsForAccountListPage" =>null,
                                            "accountHolder" => "[]",
                                            "accountLimit" => null,
                                            "accountNo" =>null,
                                            "accountType" => [
                                                "enumType" =>null,
                                                "name" =>null
                                            ],
                                            "address" => "[]",
                                            "availableCashLimit" => null,
                                            "availableCreditLimit" => null,
                                            "bank" => [
                                                "enumType" =>null,
                                                "name" =>null
                                            ],
                                            "bankAccountUID" =>null,
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
                                        "cash_deposits"=>isset($bankAnalyser['deposit_transactions'])?BankofIndia::cashDeposits($bankAnalyser['deposit_transactions']):[],
                                        "expenses"=>[
                                              [
                                                "amount" => null,
                                                "bank" => null,
                                                "category" =>null,
                                                "date" =>null,
                                                "description" =>null,
                                                "merchantType" => null,
                                                "mode" =>null,
                                                "monthAndYear" => null,
                                                "partyName" => null,
                                                "purpose" =>null,
                                                "total" => null
                                              ]
                                              ],
                                        "high_value_transactions"=>[
                                             [
                                                "amount"=>null,
                                                "balanceAfterTranscation"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "type"=>null
                                             ],
                                         
                                            ],
                                         "incomes"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=> null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "isSalary"=>null,
                                                "isSalaryCheck"=>null,
                                                "mode"=>null,
                                                "monthAndYear"=>null,
                                                "partyName"=> null,
                                                "purpose"=> null,
                                                "total"=>null,
                                                "transactionType"=>null
                                            ]
                                            ],
                                         "internalTransactionList"=>[],
                                         "investments"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "transactionSubCategory"=>null,
                                                "type"=>null
                                            ]
                                            ],
                                         "minimum_balances"=>isset($bankAnalyser['monthwise_stats'])?BankofIndia::minimumBalance($bankAnalyser['monthwise_stats']):[],
                                          "missingMonths"=>[],
                                          "money_received_transactions"=>[
                                            [
                                                "amount"=>null,
                                                "balanceAfterTransaction"=>null,
                                                "bank"=>null,
                                                "category"=>null,
                                                "date"=>null,
                                                "description"=>null,
                                                "monthAndYear"=>null,
                                                "total"=>null,
                                                "transactionType"=>null
                                            ],
                                          ],
                                          "inward_cheque_return"=>[
                                             [
                                                "date"=>null,
                                                "amount"=>null,
                                                "description"=>null,
                                                "balance"=>null,
                                                "category"=>null,
                                                "remark"=> null,
                                                "transactionType"=>null,
                                                "bank"=>null,
                                              ]
                                           ],
                                           "salary"=>[
                                            "average"=>isset($bankAnalyser['average_balance'])?$bankAnalyser['average_balance']:null,
                                            "monthlyDetails"=> [
                                                [
                                                    "monthYear"=>null,
                                                    "total"=>null,
                                                    "value"=>null
                                                ]
                                            ],
                                            "total"=>isset($bankAnalyser['total_balance'])?$bankAnalyser['total_balance']:null,
                                            "totalValue"=>isset($bankAnalyser['total_deposit'])?$bankAnalyser['total_deposit']:null
                                        ]
                                     ];
                                 break; 
                        default:
                            return response()->json([
                                'statusCode' => 102,
                                'message' => "Please enter valid bank name."
                            ]);
                    }
                    return response()->json(['statusCode'=>200,'response'=>$bankfinalanalyserResponse]);
                }
              
                elseif (isset($bank_analyser['Data']['error']) && $bank_analyser['Data']['error'] == "'Withdrawal'" || $bank_analyser['Data']['error'] == "'Deposit'" ||  $bank_analyser['Data']['error'] == "'Balance'") {
                    $statusCode = 102;
                    $errorMessage = "something is wrong.";
                       if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                            }
                        }
                      return response()->json(['statusCode' => 102, 'message' => $errorMessage]);
                } 
                elseif (isset($http_code) && $http_code == 500) {
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                        }
                     return response()->json(['statusCode' => 102, 'message' => "Invalid bank statement and bank name. Please enter valid bank statement and  bank name."]);
                 }
                 else{
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',500);
                        }
                    }
                    return response()->json(['statusCode' =>500, 'message' => "Internal Server Error.Please contact techsupport@docboyz.in. for more details."]);
                 }
        }
        else{
            return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your plan.']);
        }
        }
        else{
            return response()->json(['statusCode'=>103, 'message'=>'You are not registered to use this service. Please update your plan.']);
        }
    }
    public function bankReader(Request $request){
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
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'http://13.233.136.139:8080/reader',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => ['pdf' => new \CURLFILE($_FILES['bankStmt']['tmp_name'], $_FILES['bankStmt']['type'], $_FILES['bankStmt']['name']),
                'bankName'=>$request->BankName,
                'accountType'=>$request->accountType,
                'password'=>$request->password
                 ],
            ]);
            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $bankstatment = json_decode($response, true);
            if (isset($bankstatment['statuscode']) && $bankstatment['statuscode']==200) {
                   if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    }
                $bankStatement = $bankstatment['Data'];
                $bankName = $request->BankName;
                $bankfinalStatement=null;
                switch ($bankName){
                    case 'Indian Bank':
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
                          "transactions" => isset($bankStatement)?BankReader::getIndianBankTrans($bankStatement):[],
                          "FraudAnalytics" => [
                            "fraudAnalyticStatus" => null,
                            "result" => null,
                            "summary" => null,
                            "status" => null
                          ]
                        ];
                        
                      break;
                      case 'Kotak Bank':
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
                          "transactions" =>isset($bankStatement)?BankReader::getKotakBankTrans($bankStatement):[],
                          "FraudAnalytics" => [
                            "fraudAnalyticStatus" => null,
                            "result" => null,
                            "summary" => null,
                            "status" => null
                          ]
                        ];
                       
                    break;
                    case 'Hdfc Bank':
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
                            "transactions" =>isset($bankStatement)?BankReader::getHdfcBankTrans($bankStatement):[],
                            "FraudAnalytics" => [
                              "fraudAnalyticStatus" => null,
                              "result" => null,
                              "summary" => null,
                              "status" => null
                            ]
                          ];
                        break;
                        case'ICICI Bank':
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
                                "transactions" => isset($bankStatement)?BankReader::getICICIBankTrans($bankStatement):[],
                                "FraudAnalytics" => [
                                  "fraudAnalyticStatus" => null,
                                  "result" => null,
                                  "summary" => null,
                                  "status" => null
                                ]
                              ];
                        break;
                        case 'Bank of Baroda':
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
                                "transactions" => isset($bankStatement)?BankReader::getBankofBorada($bankStatement):[],
                                "FraudAnalytics" => [
                                  "fraudAnalyticStatus" => null,
                                  "result" => null,
                                  "summary" => null,
                                  "status" => null
                                ]
                              ];
                        break;
                         case 'Bank of India':
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
                                "transactions" =>isset($bankStatement)?BankReader::getBankOfInda($bankStatement):[],
                                "FraudAnalytics" => [
                                  "fraudAnalyticStatus" => null,
                                  "result" => null,
                                  "summary" => null,
                                  "status" => null
                                ]
                              ];
                        break;
                        case 'Yes Bank':
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
                                "transactions" => isset($bankStatement)? BankReader::getYesBankTrans($bankStatement):[],
                                "FraudAnalytics" => [
                                  "fraudAnalyticStatus" => null,
                                  "result" => null,
                                  "summary" => null,
                                  "status" => null
                                ]
                              ];
                            break;
                     default:
                       return response()->json(['statusCode'=>102,'message'=>"Please enter valid bank name."]);
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
            } 
            elseif (isset($http_code) && $http_code == 500) {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                        }
                    }
             return response()->json(['statusCode' => 102, 'message' => "Invalid bank statement and bank name. Please enter valid bank statement and  bank name."]);
             }
             else{
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',500);
                    }
                }
                return response()->json(['statusCode' =>500, 'message' => "Internal Server Error.Please contact techsupport@docboyz.in. for more details."]);
             }
        } 
        else {
            return response()->json(['statusCode' =>500, 'message' => 'Please Recharge your wallet.']);
        }
       }
        else{
           return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
    }

}