<?php
namespace App\Helpers\BankAnalyser;

class HDFC{
    public static function atm_withdrawls($atm_withdrawls){
        $atmwithdrawls=[];
        foreach($atm_withdrawls as $k=>$response){
          $normilizeatmwithdrawls = [
              'amount' => isset($response['Closing Balance'])?$response['Closing Balance']: null,
              'bank' =>null,
              'date' => isset($response['Date'])?$response['Date']:null,
              'description' => isset($response['Narration']) ? $response['Narration'] : null,
              'monthAndYear' =>isset($response['YearMonth']) ?$response['YearMonth']: null,
              'total' =>null,
            
          ];
          $atmwithdrawls[$k] = $normilizeatmwithdrawls;
      }
      return $atmwithdrawls;
  }
  public static function averageMonthlyBalance($averageMonthlyBalance){
      $average_Monthlybalance=[];
      foreach($averageMonthlyBalance as $k=>$response){
        $normilizeaverageMonthlyBalance = [
            'netAverageBalance' => isset($response['Closing Balance Average'])?$response['Closing Balance Average']: null,
            'monthAndYear' =>isset($response['YearMonth'])?$response['YearMonth']: null,
            'dayBalanceMap' =>null,
       ];
        $average_Monthlybalance[$k] = $normilizeaverageMonthlyBalance;
    }
    return $average_Monthlybalance;
  }
  public static function cashDeposits($cashDeposits){
      $cash_deposits=[];
      foreach($cashDeposits as $k=>$response){
        $normilized_cashdeposits = [
            "amount" =>isset($response['Closing Balance'])?$response['Closing Balance']: null,
            "balanceAfterTransaction" =>null,
            "bank" =>null,
            "category" =>null,
            "date" =>isset($response['Date'])?$response['Date']: null,
            "description" =>isset($response['Narration'])?$response['Narration']: null,
            "mode" => null,
            "partyName" =>null,
            "purpose" =>null,
            "total" =>null,
            "transactionType" =>null
       ];
        $cash_deposits[$k] = $normilized_cashdeposits;
    }
    return $cash_deposits;
  }
  public static function minimumBalance($minimumBalances){
      $minimum_balance=[];
      foreach($minimumBalances as $k=>$response){
        $normilized_minimum_balance = [
            "amount" =>isset($response['Closing Balance Minimum'])?$response['Closing Balance Minimum']:null,
            "balanceAfterTransaction" =>null,
            "bank" =>null,
            "category" =>null,
            "date"=>null,
            "description" =>null,
            "transactionType" =>null
       ];
        $minimum_balance[$k] = $normilized_minimum_balance;
    }
    return $minimum_balance;
  }
}