<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Animal;

class AnimalController extends Controller
{
	public function display()
	{
		$animalsQuery = Animal::all();
		return view('/display', array('animals'=>$animalsQuery));
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$animals = Animal::all()->toArray();
		return view('animals.index', compact('animals'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//form validation
    	$animal = $this->validate(request(), [
    		'name' => 'required',
    		'dob' => 'required',
    		'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
    	]);

		//Handles the uploading of the image
    	if ($request->hasFile('picture')) {
			//Gets the filename with the extension
    		$fileNameWithExt = $request->file('picture')->getClientOriginalName();
			//Just gets the filename
    		$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			//Just gets the extension
    		$extension = $request->file('picture')->getClientOriginalExtension();
			//Gets the filename to store
    		$filenameToStore = $filename.'_'.time().'.'.$extension;

			//Uploads the image
    		$path = $request->file('picture')->storeAs('public/images', $filenameToStore);
    	} else {
    		$filenameToStore = 'noimage.jpg';
    	}
		//Create an Animal object and set its values from the input
    	$animal = new Animal;
    	$animal->name = $request->input('name');
    	$animal->dob = $request->input('dob');
    	$animal->description = $request->input('description');
    	$animal->picture = $filenameToStore;

		//Save the Animal object
    	$animal->save();
		//Generate a redirect HTTP response with a success message
    	return back()->with('success', 'Animal has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$animal = Animal::find($id);
    	return view('animals.show',compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animal::find($id);
        return view('animals.edit',compact('animal'));
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
    	$animal = Animal::find($id);
    	$this->validate(request(), [
    		'name' => 'required',
    		'dob' => 'required',
    		'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
    	]);
    	$animal->name = $request->input('name');
    	$animal->dob = $request->input('dob');
    	$animal->description = $request->input('description');
    	$animal->availability = $request->input('availability');
    	$animal->picture = $request->input('picture');
		//Handles the uploading of the picture
    	if ($request->hasFile('picture')){
		//Gets the filename with the extension
    		$fileNameWithExt = $request->file('picture')->getClientOriginalName();
		//just gets the filename
    		$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
		//Just gets the extension
    		$extension = $request->file('picture')->getClientOriginalExtension();
		//Gets the filename to store
    		$fileNameToStore = $filename.'_'.time().'.'.$extension;
		//Uploads the picture
    		$path = $request->file('picture')->storeAs('public/images', $fileNameToStore);
    	} else {
    		$fileNameToStore = 'noimage.jpg';
    	}
    	$animal->picture = $fileNameToStore;
    	$animal->save();
    	return redirect('animals')->with('success','Animal has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$animal = Animal::find($id);
    	$animal->delete();
    	return redirect('animals')->with('success','Animal has been deleted');
    }

}