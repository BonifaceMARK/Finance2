<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function dashboard()
    {
        $user = Auth::user();

        // Retrieve the user's name
        $userName = $user->name;

        // Retrieve the remaining budget balance (adjust this according to your application's logic)
        $remainingBudget = null;
        $budgetBalance = $user->budgetBalance; // Assuming you have defined the relationship correctly
        if ($budgetBalance) {
            $remainingBudget = $budgetBalance->remaining_amount;
        }

        return view('user.dashboard', compact('userName', 'remainingBudget'));

    }
}
