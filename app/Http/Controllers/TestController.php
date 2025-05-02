<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    //
    public function testPdf(){

    $pdf = PDF::loadView('welcome')->setPaper('A4');
    return $pdf->stream('invoice.pdf');
    }
}
