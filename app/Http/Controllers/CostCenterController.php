<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{

    public function index()
    {
        $costCenters = CostCenter::all();
        return view('sub-admin.cost_centers.index', compact('costCenters'));
    }


    public function create()
    {
        return view('sub-admin.cost_centers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        CostCenter::create($request->all());

        return redirect()->route('cost_centers.index')
                         ->with('success','Cost center created successfully.');
    }

    public function show(CostCenter $costCenter)
    {
        return view('sub-admin.cost_centers.show',compact('costCenter'));
    }


    public function edit(CostCenter $costCenter)
    {
        return view('sub-admin.cost_centers.edit',compact('costCenter'));
    }

    public function update(Request $request, CostCenter $costCenter)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $costCenter->update($request->all());

        return redirect()->route('cost_centers.index')
                         ->with('success','Cost center updated successfully');
    }


    public function destroy(CostCenter $costCenter)
    {
        $costCenter->delete();

        return redirect()->route('cost_centers.index')
                         ->with('success','Cost center deleted successfully');
    }
}
