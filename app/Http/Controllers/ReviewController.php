<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Animal;
use App\Adoption;

class ReviewController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$animalsQuery = Animal::all();
		$users = User::all();
		$adoptionsQuery = Adoption::all();
		return view('admin.review_requests', array('animals'=>$animalsQuery, 'users'=>$users, 'adoptions'=>$adoptionsQuery));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$adoption = Adoption::find($id);
    	$animalId = $adoption->animalId;
    	$this->validate(request(), [
    		'status' => 'required',
    	]);
    	$adoption->status = $request->input('status');
    	$adoption->save();
    	
    	if ($adoption->status == 'Accepted') {

    		$pendings = Adoption::where("animalId", "=", $animalId)->where("status", "=", "Pending")->get();
    		foreach ($pendings as $pending) {
    			$pending->status = 'Rejected';
    			$pending->save();
    		}

            $animal = Animal::where("id", "=", $animalId)->first();
            $animal->availability = "Unavailable";
            $animal->save();

    	}

    	return redirect('reviews')->with('success','Adoption has been updated');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//
    }

}
