<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Image;
use App\Adoption;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $username = \Auth::user()->username;
        return view('home', array('username'=>$username));
    }

    public function admin()
    {
        return view('admin.admin_home');
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
        $adoption = $this->validate(request(), [
            'userId' => 'required',
            'animalId' => 'required',
        ]);

        //Create an Adoption object and set its values from the input
        $adoption = new Adoption;
        $adoption->userId = $request->input('userId');
        $adoption->animalId = $request->input('animalId');

        //Save the Adoption object
        $adoption->save();
        //Generate a redirect HTTP response with a success message
        return back()->with('success', 'Adoption request has been added');
    }

    /**
    * Show the application page displaying available animals.
    *
    * @return \Illuminate\Http\Response
    */
    public function animals(Request $request)
    {
        $filter = $request->input("filter");
        $requested = false;
        $images = Image::all();
        $animalsQuery = Animal::all();
        $userId = \Auth::user()->id;
        $username = \Auth::user()->username;
        $adoptionsQuery = Adoption::all();
        return view('animals', array('filter'=>$filter, 'animals'=>$animalsQuery, 'userId'=>$userId, 'username'=>$username, 'adoptions'=>$adoptionsQuery, 'requested'=>$requested, 'images'=>$images));
    }

    /**
    * Show the application page displaying information on a specific animal.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function showAnimal($id){
        $animal = Animal::find($id);
        $pictures = Image::where("animalId", "=", $id)->get();
        return view('show', array('animal'=>$animal, 'pictures'=>$pictures));
    }

}
