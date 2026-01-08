<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        if(Auth::user()->role_id == 0) {
            $transactions = Transaction::with('api_master')->orderBy('id', 'DESC')->withoutGlobalScopes()->limit(5000)->get();
            // return $transactions[0]->api_master->api_name;
        } else {
            $transactions = Transaction::with('api_master')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->withoutGlobalScopes()->limit(5000)->get();
            // dd($transactions);
        }
    	return view('transactions.list', compact('transactions'));
    }
}
