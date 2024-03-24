<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TransactionReport;

class ApiController extends Controller
{

    public function fetchData()
    {
        // Fetch transaction data from the database
        $transactions = TransactionReport::all();

        // Return the data as JSON response
        return response()->json($transactions);
    }
}