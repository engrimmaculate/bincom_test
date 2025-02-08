<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\BinaryOp\Concat;
use Termwind\Components\Raw;

class PollingUnitController extends Controller
{
    //
    public function index()
    {
        // Fetch polling units from the database
        $pollingUnits = DB::table('polling_units')->select('*')->get();


        return view('layouts.index', compact('pollingUnits'));
    }

    // create a new polling unit
    public function create()
    {
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        $lgas= DB::table('lga')->select ('lga_id','lga_name')->get();
        $wards= DB::table('ward')->select ('uniqueid','ward_id','ward_name','lga_id','ward_description','entered_by_user')->get();

        return view('pages.add_pu_results',compact('lgas','pu','wards'));
    }

    // store a new polling unit
    public function store(Request $request)
    {
        // Validate the request data
        // dd($request->all());
        $data = $request->validate([
            'polling_unit_uniqueid'=> 'required|string|not_in:0',
            'party_abreviation'=> 'required|string|max:255',
            'party_score'=> 'required|string|max:255',
            'entered_by'=> 'required|string|max:255',
            'date_entered'=> 'required|string|max:255',
            'user_ip_address'=> 'required|string|max:255',
        ]);

        // Insert the new polling unit into the database
        $results = DB::table('announced_pu_results')->insert([
           'polling_unit_uniqueid'=>$data['polling_unit_uniqueid'],
            'party_abbreviation'=>$data['party_abreviation'],
            'party_score'=>$data['party_score'],
            'entered_by_user'=>$data['entered_by'],
            'date_entered'=>$data['date_entered'],
            'user_ip_address'=>$data['user_ip_address']
        ]);

        // dd($data,$results);
        // Redirect to the polling units result page
        //
       
        // dd($latest_results,$pu);
        // return view('pages.list', compact('latest_results', 'pu','lgas'))->with('success', 'Polling Unit added successfully.');
        // return redirect()->route('pu.search')->with('success', 'Polling Unit added successfully.',['latest_results'=>$latest_results,'pu'=>$pu,'lgas'=>$lgas]);
        return redirect()->route('polling-unit.results')->with('success', 'Polling Unit added successfully.');
    }

    public function results(){
        // Fetch the latest 10 polling unit results from the database
        $latest_results = DB::table('announced_pu_results')->select('*')->latest('result_id')->limit(10)->get();

        // Fetch polling units from the database
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        

        // Fetch LGA and ward names from the database
        $lgas= DB::table('lga')->select ('lga_id','lga_name')->get();
        $wards = DB::table('ward')->select('ward_id', 'ward_name', 'lga_id')->get();

        return view('pages.pu_results',compact('latest_results', 'pu','lgas'))->with('success', 'Polling Unit added successfully.');
    }
}
