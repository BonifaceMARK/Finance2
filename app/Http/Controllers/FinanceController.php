<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function showTerms()
    {
        return view('finance.terms');
    }
}

