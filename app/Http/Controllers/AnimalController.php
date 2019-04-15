<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Animal;
use App\User;
use App\Adoption;
use App\Image;

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
		$animals = Animal::all();
        $users = User::all();
        $adoptions = Adoption::all();
        return view('animals.index', array('animals'=>$animals,'users'=>$users, 'adoptions'=>$adoptions));
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
    	]);

		//Create an Animal object and set its values from the input
    	$animal = new Animal;
    	$animal->name = $request->input('name');
    	$animal->dob = $request->input('dob');
        $animal->type = $request->input('type');
        $animal->description = $request->input('description');

		//Save the Animal object
        $animal->save();

        $this->addPicture($request, $animal->id);
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
        $pictures = Image::where("animalId", "=", $id)->get();
    	return view('animals.show', array('animal'=>$animal, 'pictures'=>$pictures));
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
            'type' => 'required',
        ]);
    	$animal->name = $request->input('name');
    	$animal->dob = $request->input('dob');
        $animal->type = $request->input('type');
        $animal->description = $request->input('description');
        $animal->availability = $request->input('availability');
        $this->addPicture($request, $id);
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

        $adoptions = Adoption::where("animalId", "=", $id)->get();
        foreach ($adoptions as $adoption) {
            $adoption->delete();
        }
        
        return redirect('animals')->with('success','Animal has been deleted');
    }

    public function addPicture(Request $request, $animalId){
        $this->validate(request(), [
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
        ]);
        $image = new Image;
        $image->animalId = $animalId;
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
        $image->picture = $fileNameToStore;
        $image->save();
    }

}