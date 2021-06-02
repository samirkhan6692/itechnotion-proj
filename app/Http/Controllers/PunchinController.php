<?php

namespace App\Http\Controllers;

use App\Models\Punchin;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PunchinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $punchins = Punchin::latest()->paginate(10);
    
        return view('punchins.index',compact('punchins'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::get();
        return view('punchins.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required'
        ]);
  
        $input = $request->all();
        $id = $request['employe_id'];
        $punch = DB::table('punchins')
             //->whereDate('created_at', '>=', Carbon::now())
             ->where('employe_id', $id)
             ->get();
    
        if(!$punch->isEmpty()){
        	$punch_dt_time = $request['punchin_datetime'];
        	$k=1;
        	foreach ($punch as $key => $val) {
        		if($val->punchout_datetime==''){
        			$k=0;
        			DB::table('punchins')
		                ->where('employe_id', $id)
		                ->update(['punchout_datetime' => $punch_dt_time]);
        		}
        	}
        	if($k==1){
        		Punchin::create($input);
        	}
        }else{
            Punchin::create($input);
        }
        return redirect()->route('punchins.index')
                        ->with('success','Punched successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Punchin  $punchin
     * @return \Illuminate\Http\Response
     */
    public function show(Punchin $punchin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Punchin  $punchin
     * @return \Illuminate\Http\Response
     */
    public function edit(Punchin $punchin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Punchin  $punchin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Punchin $punchin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Punchin  $punchin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Punchin $punchin)
    {
        //
    }
}
