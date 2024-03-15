<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\RequestBudget;

class RequestBudgetController extends Controller
{

    public function index()
    {
        // Fetch all request budgets
        $requestBudgets = RequestBudget::all();

        // Return view with request budgets data
        return view('user.request_budgets.index', compact('requestBudgets'));
    }


    public function create()
    {
        // Return the create form view
        return view('user.request_budgets.create');
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Create a new request budget
        RequestBudget::create($request->all());

        // Redirect to the index page with success message
        return redirect()->route('request_budgets.index')
            ->with('success', 'Request budget created successfully.');
    }


    public function show($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Return view with request budget data
        return view('user.request_budgets.show', compact('requestBudget'));
    }


    public function edit($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Return the edit form view with request budget data
        return view('user.request_budgets.edit', compact('requestBudget'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Update the request budget
        $requestBudget->update($request->all());

        // Redirect to the index page with success message
        return redirect()->route('request_budgets.index')
            ->with('success', 'Request budget updated successfully.');
    }


    public function destroy($id)
    {
        // Find the request budget by id
        $requestBudget = RequestBudget::findOrFail($id);

        // Delete the request budget
        $requestBudget->delete();

        // Redirect to the index page with success message
        return redirect()->route('request_budgets.index')
            ->with('success', 'Request budget deleted successfully.');
    }
}
