<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{

    public function index()
    {
        $reports = Report::all();
        return view('Sub-admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('Sub-admin.reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'expense' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Report::create($request->all());

        return redirect()->route('reports.index')
            ->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        return view('Sub-admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('Sub-admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'category' => 'required',
            'expense' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $report->update($request->all());

        return redirect()->route('reports.index')
            ->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }
}
