<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\RequestBudget;
use App\Models\CostAllocation;

class ForecastController extends Controller
{
    public function forecastIndex()
    {
        try {
            $expenses = Expense::all();
            $requestBudgets = RequestBudget::all();
            $costAllocations = CostAllocation::all();

            // Fetch transactions data from the external API
            $transactionsResponse = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');
            if (!$transactionsResponse->successful()) {
                throw new \Exception('Failed to fetch transaction data from the external API');
            }
            $transactions = $transactionsResponse->json();
            $prices = [];
            $dates = [];
            foreach ($transactions as $transaction) {
                $prices[] = $transaction['transactionAmount'];
                $dates[] = $transaction['transactionDate'];
            }

            // Fetch allocation data from the external API
            $allocationResponse = Http::get('https://fms1-fpfrcm.fguardians-fms.com/allocatebud');
            if (!$allocationResponse->successful()) {
                throw new \Exception('Failed to fetch allocation data from the external API');
            }
            $data = $allocationResponse->json();

            // Fetch cash data from the external API
            $cashResponse = Http::get('https://fms1-fpfrcm.fguardians-fms.com/cash');
            if (!$cashResponse->successful()) {
                throw new \Exception('Failed to fetch cash data from the external API');
            }
            $cashData = $cashResponse->json()['data'];



            $totalNotifications = $expenses->count() + $requestBudgets->count() + $costAllocations->count();

            // Fetch external user data
            $externalUserDataResponse = Http::get('https://fms10-vaims.fguardians-fms.com/api/payments?fbclid=IwAR0ETfwWSbW840E6an54en2YtbS3raGW0a9GMy6zVy2Z-E_eBGibLpQ_g9Y_aem_AUOZ9gvYqvvhWaX3tEkHUGRu7ti9rg6VSzNuZAffhG5YuksZtISSq-oVLekLl8T6iW2dxvcVTb1wFQkOvKJnONLs');
            if (!$externalUserDataResponse->successful()) {
                throw new \Exception('Failed to fetch external user data from the API');
            }
            $externalUserData = $externalUserDataResponse->json()['users'];
                // Convert timestamps to human-readable date format for x-axis categories
                $xAxisCategories = array_map(function($item) {
                    return date('Y-m-d H:i:s', strtotime($item['created_at']));
                }, $data);

            return view('user.forecast', compact('data', 'xAxisCategories','prices', 'dates', 'expenses', 'requestBudgets', 'costAllocations', 'totalNotifications', 'cashData', 'externalUserData'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
