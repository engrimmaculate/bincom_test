<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedPollingUnitResult;
use App\Models\PollingUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\BinaryOp\Concat;
use Termwind\Components\Raw;

class AnnouncedPollingUnitResultController extends Controller
{
    //
   
    public function index()
    {
        $results = DB::table('announced_pu_results')->select('*')->orderBy('polling_unit_uniqueid')->get(); //
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        $lgas= DB::table('lga')->select ('lga_id','lga_name')->get();
        // dd($results,$pu);
        return view('pages.list', compact('results', 'pu','lgas'));
    }


        /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function autocomplete(Request $request): JsonResponse

     {
 
        $data = DB::table('polling_unit')->select("polling_unit_number as value", "uniqueid","polling_unit_name")

        ->where('polling_unit_number', 'LIKE', '%'. $request->get('search'). '%')

        ->get();



        return response()->json($data);
 
     }


    //  Show Polling Units individual Results   

    public function show(Request $request)

    {

        // Validate Data from form
        $data= $request->validate([
            'pu' =>'required',
            'id' =>'required',
            'pu_name' =>'required',
        ]);
    // Get the Announced Results for a specified PU
        $results = DB::table('announced_pu_results')->select("*")
        ->where('polling_unit_uniqueid',  $data['id'])
        ->orderBy('party_abbreviation', 'asc')
        ->get();
    //Get the LGA
        $lgas= DB::table('lga')->select ('lga_id','lga_name')->get();
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        return view('pages.list', compact('results', 'pu','data','lgas'));
    }

    // edit Polling Unit Results
    public function edit($id){
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        $result = DB::table('announced_pu_results')->select('id',$id)->first();
        return view('pages.edit', compact('result', 'pu'));
    }
    

    // Update Polling Unit Result
    public function update(Request $request, $id)
    {
        $result = DB::table('announced_pu_results')->select('id',$id)->first();
        $result->update([
            'party_abbreviation' => $request->party_abbreviation,
            'party_percentage' => $request->party_percentage,
            'votes_received' => $request->votes_received,
            'votes_percentage' => $request->votes_percentage,
        ]);
        return redirect()->route('announced_pu_results.index')->with('success', 'Polling Unit Result updated successfully');
    }

    // Delete Polling Unit Result
    public function destroy($id)
    {
        $result = DB::table('announced_pu_results')->select('id',$id)->first();
        return redirect()->route('announced_pu_results.index')->with('success', 'Polling Unit Result deleted successfully');
    }


    // get summed results of polling unit by local government
    public function getSummedResults(Request $request){
        $id = $request->validate([
            'lga' =>trim(htmlspecialchars(strip_tags(stripslashes('required')))),
        ]);
        $lga = DB::table('lga')
        ->select('lga_name')
        ->where('lga_id', $id)
        ->first();

       


       
        $summed_results = DB::table('lga')
        ->join('polling_unit', 'lga.lga_id', '=', 'polling_unit.lga_id')
        ->join('announced_pu_results', 'polling_unit.uniqueid', '=', 'announced_pu_results.polling_unit_uniqueid')
        ->select('lga.lga_id', 'lga.lga_name','polling_unit.uniqueid','polling_unit.polling_unit_name', 'announced_pu_results.polling_unit_uniqueid', DB::raw("SUM(announced_pu_results.party_score)  as score"))
        ->groupBy('lga.lga_id', 'lga.lga_name','polling_unit.uniqueid', 'polling_unit.polling_unit_name', 'announced_pu_results.polling_unit_uniqueid')
        ->where('lga.lga_id', $id)
        ->get();

        //  dd($summed_results);
        $lgas= DB::table('lga')->select ('lga_id','lga_name')->get();
        $pu= DB::table('polling_unit')->select ('uniqueid','polling_unit_id','polling_unit_number','polling_unit_name')->get();
        return view('pages.list', compact('summed_results', 'pu','lgas','lga'));
    }

    // Store results
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
        // Redirect to the polling units index page
        return redirect()->route('pu.search')->with('success', 'Polling Unit added successfully.');
    }    

}
