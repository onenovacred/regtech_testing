<?php
namespace App\Helpers;

class BankReader {
    public static function getIndianBankTrans($bankStatement) {
        $statements = [];
        foreach($bankStatement as $k=>$response){
            $normalizedResponse = [
                'amount' => isset($response['CR']) && $response['CR'] !== '' ? $response['CR'] : (isset($response['DR']) && $response['DR'] !== '' ? $response['DR'] : null),
                'balanceAfterTransaction' => isset($response['Balance']) ? $response['Balance'] : null,
                'bank' =>'Indian Bank',
                'batchID' => isset($response['category']) ? $response['category'] : 'OPENING_BALANCE',  // Default to 'OPENING_BALANCE'
                'category' => isset($response['category']) ? $response['category'] : null,
                'dateTime' => isset($response['Post Date']) ? $response['Post Date'] : null,
                'description' => isset($response['Description']) ? $response['Description'] : null,
                'remark' => isset($response['Remitter Branch']) ? $response['Remitter Branch'] : '',
                'transactionId' =>$response['Chq./Ref.No.'] ?? null,
                'transactionNumber' => '',
                'type' => isset($response['CR']) && $response['CR'] !== '' ? 'credit' : (isset($response['DR']) && $response['DR'] !== '' ? 'debit' : ''),
                'valueDate' => isset($response['Value Date']) ? $response['Value Date'] : '',
            ];
            $statements[$k] = $normalizedResponse;
        }
        return $statements;
    }
    public static function getKotakBankTrans($bankStatement){
        $statements = [];
       foreach($bankStatement as $k => $response){
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
        'valueDate' =>null
    ];
       $statements[$k] = $normalizedResponse;
    }
     return $statements;
    }
    public static function getHdfcBankTrans($bankStatement){
        $statements = [];
        foreach($bankStatement as $k=> $response){
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
       return  $statements;
    }
    public static function getICICIBankTrans($bankStatement){
        $statements = [];
        foreach($bankStatement as $k=> $response){
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
        return  $statements;
    }
    public static function getBankofBorada($bankStatement){
        $statements = [];
        foreach($bankStatement as $k=> $response){
            $normalizedResponse = [
                'amount' => isset($response['WITHDRAWAL (DR)']) && $response['WITHDRAWAL (DR)'] !== '' ? $response['WITHDRAWAL (DR)'] : (isset($response['DEPOSIT(CR)']) && $response['DEPOSIT(CR)'] !== '' ? $response['DEPOSIT(CR)'] : null),
                'balanceAfterTransaction' => isset($response['BALANCE(INR)']) ? $response['BALANCE(INR)'] : null,
                'bank' => 'Bank Of Baroda', 
                'batchID' => null,
                'category' =>null, 
                'dateTime' => isset($response['DATE']) ? $response['DATE'] : null,
                'description' => isset($response['NARRATION']) ? $response['NARRATION'] : null,
                'remark' => '',
                'transactionId' => null,  
                'transactionNumber' => isset($response['CHQ.NO.']) ? $response['CHQ.NO.'] :null,
                'type' => isset($response['WITHDRAWAL (DR)']) && $response['WITHDRAWAL (DR)'] !== '' ? 'DEBIT' : (isset($response['DEPOSIT(CR)']) && $response['DEPOSIT(CR)'] !== '' ? 'CREDIT' : ''),
                'valueDate' => ''
            ];
            $statements[$k] = $normalizedResponse;
        }
        return  $statements;
    }
    public static function getBankOfInda($bankStatement){
        $statements = [];
        foreach($bankStatement as $k => $response){
            $normalizedResponse = [
                'amount' => isset($response['Withdrawal (in Rs.)']) && $response['Withdrawal (in Rs.)'] !== '' ? $response['Withdrawal (in Rs.)'] : (isset($response['Deposits (in Rs.)']) && $response['Deposits (in Rs.)'] !== '' ? $response['Deposits (in Rs.)'] : null),
                'balanceAfterTransaction' => isset($response['Balance (in Rs.)']) ? $response['Balance (in Rs.)'] : null,
                'bank' => 'BOI', 
                'batchID' => null,
                'category' =>null, 
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
    return  $statements;
}
  public static function getYesBankTrans($bankStatement){
    $statements = [];
    foreach($bankStatement as $k => $response){
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
            'valueDate' => isset($response['Value Date']) ? $response['Value Date'] :null
        ];
        $statements[$k] = $normalizedResponse;
    }
    return $statements;
   }
}