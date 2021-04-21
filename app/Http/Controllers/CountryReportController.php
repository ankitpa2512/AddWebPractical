<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CountryReports;

class CountryReportController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $reports = CountryReports::select('data')->orderBy('id', 'DESC')->paginate(25);
        return view('welcome', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => 'required'
        ]);
        $countryReports = New CountryReports();
        $countryReports->data = $request->report;
        if($countryReports->save()){
            return redirect()->back()->with('success', 'Data has been inserted successfully.');
        }
        return redirect()->back()->with('error', 'Opps, Something went wrong. Please try after sometime.');
    }

}